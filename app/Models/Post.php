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

    public function dataKategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function dataTagPost()
    {
        return $this->hasMany(TagPost::class, 'post_id', 'id');
    }
}