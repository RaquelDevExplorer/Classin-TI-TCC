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

    /**
     * Retrieve the URL of the photo for the current profile.
     *
     * @return string The URL of the photo.
     */
    public function getFotoUrl()
    {
        return "/storage/profiles/{$this->foto}";
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

    public function agenda()
    {
        return $this->hasOne(Agenda::class);
    }

    public function caderno()
    {
        return $this->hasOne(Caderno::class);
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
