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
    ];

    public function dataKategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function dataTagPost()
    {
        return $this->hasMany(TagPost::class, 'post_id', 'id');
    }
    public function dataTags()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function scopePublish($query)
    {
        return $query->where('status', "publish");
    }
    public function scopeDraft($query)
    {
        return $query->where('status', "draft");
    }

    public function scopeSearch($query, $judul)
    {
        return $query->where('judul', 'LIKE', "%($judul)%");
    }
}
