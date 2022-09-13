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
        'isi',
        'parent'
    ];
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }
    public function dataPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function dataUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dataChilds()
    {
        return $this->hasMany(Komentar::class, 'parent');
    }
}