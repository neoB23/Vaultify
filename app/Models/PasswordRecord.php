<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordRecord extends Model
{
    use HasFactory;

    protected $table = 'password_record';

    protected $fillable = [
        'user_id', 'title', 'username', 'password', 'url', 'notes', 'category_id', 'favorite', 'last_used_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
