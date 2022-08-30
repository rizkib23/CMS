<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'thumbnail'
    ];

    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
