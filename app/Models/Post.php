<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'thumbnail',
        'deskripsi',
        'content',
        'kategori_id',
        'status',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}