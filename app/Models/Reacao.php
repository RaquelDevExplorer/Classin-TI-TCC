<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ReacaoTypeEnum;

class Reacao extends Model
{
    use HasFactory;

    protected $table = 'reacoes';

    protected $fillable = [
        'perfil_id',
        'post_id',
        'comentario_id',
        'target_type',
    ];

    protected $casts = [
        'target_type' => ReacaoTypeEnum::class
    ];

    public function target()
    {
        switch ($this->target_type) {
            case ReacaoTypeEnum::Post:
                return $this->belongsTo(Post::class);
            case ReacaoTypeEnum::Comentario:
                return $this->belongsTo(Comentario::class);
            default:
                return null;
        }
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }
}
