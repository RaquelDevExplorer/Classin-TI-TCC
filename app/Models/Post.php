<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'perfil_id',
        'post_ref_id',
        'folha_id',
        'corpo',
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function folha()
    {
        return $this->belongsTo(Folha::class);
    }

    public function post_ref()
    {
        return $this->belongsTo(Post::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
