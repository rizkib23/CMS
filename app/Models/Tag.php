<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tag extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded =[];
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_tag'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
