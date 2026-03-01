<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Encrypt any existing plain text passwords.
     */
    public function up(): void
    {
        Schema::table('password_record', function (Blueprint $table) {
            //
        });

        DB::transaction(function () {
            DB::table('password_record')->orderBy('id')->chunkById(100, function ($records) {
                foreach ($records as $record) {
                    // Try to decrypt — if it fails, it's plain text and needs encrypting
                    try {
                        Crypt::decryptString($record->password);
                        // Already encrypted, skip
                    } catch (\Exception $e) {
                        // Plain text — encrypt it
                        DB::table('password_record')
                            ->where('id', $record->id)
                            ->update([
                                'password' => Crypt::encryptString($record->password),
                            ]);
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
        Schema::table('password_record', function (Blueprint $table) {
            //
        });

        // Cannot safely reverse encryption
    }
};
