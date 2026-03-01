<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class PasswordRecord extends Model
{
    use HasFactory;

    protected $table = 'password_record';

    protected $fillable = [
        'user_id', 'title', 'username', 'password', 'url', 'notes', 'category_id', 'favorite', 'last_used_at'
    ];

    protected $casts = [
        'favorite' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    // ── Encrypted field helpers ────────────────────────────────────

    /**
     * Safely encrypt a value. Returns null for null/empty input.
     */
    private static function encryptValue(?string $value): ?string
    {
        return $value !== null && $value !== '' ? Crypt::encryptString($value) : null;
    }

    /**
     * Safely decrypt a value, falling back to raw value for legacy plain text.
     */
    private static function decryptValue(?string $value, ?int $id = null, string $field = ''): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            Log::warning('Failed to decrypt field on password record', [
                'id'    => $id,
                'field' => $field,
            ]);
            return $value; // legacy plain text fallback
        }
    }

    // ── Password ───────────────────────────────────────────────────

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = static::encryptValue($value);
    }

    public function getPasswordAttribute($value)
    {
        return static::decryptValue($value, $this->id, 'password');
    }

    // ── Username ───────────────────────────────────────────────────

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = static::encryptValue($value);
    }

    public function getUsernameAttribute($value)
    {
        return static::decryptValue($value, $this->id, 'username');
    }

    // ── URL ────────────────────────────────────────────────────────

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = static::encryptValue($value);
    }

    public function getUrlAttribute($value)
    {
        return static::decryptValue($value, $this->id, 'url');
    }

    // ── Notes ──────────────────────────────────────────────────────

    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = static::encryptValue($value);
    }

    public function getNotesAttribute($value)
    {
        return static::decryptValue($value, $this->id, 'notes');
    }

    // ── Raw accessors (bypass decryption) ──────────────────────────

    public function getRawPassword(): string
    {
        return $this->attributes['password'] ?? '';
    }

    public function getRawAttribute(string $field): ?string
    {
        return $this->attributes[$field] ?? null;
    }

    // ── Computed ────────────────────────────────────────────────────

    /**
     * Get the initials for the card avatar.
     */
    public function getInitialsAttribute(): string
    {
        return strtoupper(substr((string) ($this->title ?? ''), 0, 2));
    }

    /**
     * Extract domain from URL for favicon display.
     */
    public function getDomainAttribute(): ?string
    {
        $url = $this->url;
        if (!$url) return null;

        $parsed = parse_url($url);
        return $parsed['host'] ?? null;
    }

    // ── Relationships ──────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
