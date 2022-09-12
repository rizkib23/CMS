<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'isi'
    ];

    public function dataPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function dataUser()
    {
        return $this->belongsTo(User::class, 'post_id', 'id');
    }
}