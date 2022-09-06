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
        'status',
    ];

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
