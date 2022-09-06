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
        return $this->belongsTo(Post::class);
    }
}
