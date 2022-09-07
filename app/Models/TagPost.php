<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'post_id',
    ];

    public function scopeSearch($query, $name)
    {
        return $query->where('name','LIKE', "%{$name}%");
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_id', 'id');
    }

    public function dataTags()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
