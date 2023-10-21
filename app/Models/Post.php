<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'usuario_id',
        'post_ref_id',
        'folha_id',
        'corpo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function folha()
    {
        return $this->hasOne(Folha::class);
    }

    public function post_ref()
    {
        return $this->hasOne(Post::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
