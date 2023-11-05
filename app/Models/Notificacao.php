<?php

namespace App\Models;

use App\Enums\NotificacaoTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacoes';

    protected $fillable = [
        'id',
        'user_id',
        'corpo',
        'lido',
        'tipo',
    ];

    protected $casts = [
        'tipo' => NotificacaoTypeEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
