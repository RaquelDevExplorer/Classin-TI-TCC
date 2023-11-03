<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'titulo',
        'descricao',
        'dataInicio',
        'dataFim',
        'estado',
        'lembrete',
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
