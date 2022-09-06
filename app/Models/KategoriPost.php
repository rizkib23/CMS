<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'post_id',
    ];

    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
