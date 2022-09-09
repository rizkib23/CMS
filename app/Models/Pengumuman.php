<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'isi', 'tanggal', 'judul'
    ];
    public function dataUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}