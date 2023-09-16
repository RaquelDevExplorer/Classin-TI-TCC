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

    public function getFotoUrl()
    {
        return "/storage/profiles/{$this->foto}";
    }

    public function seguidores()
    {
        // TODO
    }

    public function seguindo()
    {
        // TODO
    }
}
