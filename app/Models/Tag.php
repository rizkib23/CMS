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
        'name',
        'slug',
    ];

    public function scopeSearch($query, $name)
    {
        return $query->where('name','LIKE', "%{$name}%");
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function tag_post()
    {
        return $this->belongsToMany(TagPost::class);
    }
}
