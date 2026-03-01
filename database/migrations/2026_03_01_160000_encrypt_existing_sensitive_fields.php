<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Encrypt existing plain-text username, url, and notes fields.
     * (Password encryption was handled in 2026_03_01_150741.)
     */
    public function up(): void
    {
        $fieldsToEncrypt = ['username', 'url', 'notes'];

        DB::transaction(function () use ($fieldsToEncrypt) {
            DB::table('password_record')->orderBy('id')->chunkById(100, function ($records) use ($fieldsToEncrypt) {
                foreach ($records as $record) {
                    $updates = [];

                    foreach ($fieldsToEncrypt as $field) {
                        $value = $record->{$field};

                        if ($value === null || $value === '') {
                            continue;
                        }

                        // Check if already encrypted
                        try {
                            Crypt::decryptString($value);
                            // Already encrypted — skip
                        } catch (\Exception $e) {
                            // Plain text — encrypt it
                            $updates[$field] = Crypt::encryptString($value);
                        }
                    }

                    if (!empty($updates)) {
                        DB::table('password_record')
                            ->where('id', $record->id)
                            ->update($updates);
                    }
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot safely reverse encryption
    }
};
