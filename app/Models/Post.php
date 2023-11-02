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
        'image',
        'file',
    ];

    protected $appends = [
        'created_at_formatted',
        'reacoes_count'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return 'storage/' . str_replace('public/', '', $value);
        }

        return null;
    }

    public function getReacoesCountAttribute()
    {
        return $this->reacoes()->count();
    }

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

    public function reacoes()
    {
        return $this->hasMany(Reacao::class);
    }
}
