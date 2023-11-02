<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfis';

    protected $fillable = [
        'usuario_id',
        'foto',
        'dataNasc',
        'bio',
        'escola',
        'cidade',
        'estado',
        'pais',
        'privado',
    ];

    public function getFotoAttribute($value)
    {
        return "/storage/profiles/$value";
    }

    /**
     * Retrieves the total number of posts.
     *
     * @return int The total number of posts.
     */
    public function getTotalPosts()
    {
        return $this->posts->count();
    }

    /**
     * Retrieves the total number of followers.
     *
     * @return int The total number of followers.
     */
    public function getTotalSeguidores()
    {
        return $this->seguidores->count();
    }

    /**
     * Retrieves the total number of items being followed.
     *
     * @return int The total number of profiles being followed.
     */
    public function getTotalSeguindo()
    {
        return $this->seguindo->count();
    }

    // Relacionamentos

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function seguidores()
    {
        return $this->belongsToMany(Perfil::class, 'seguidores', 'perfil_id', 'id');
    }

    public function seguindo()
    {
        return $this->belongsToMany(Perfil::class, 'seguidores', 'seguidor_id', 'id');
    }
}
