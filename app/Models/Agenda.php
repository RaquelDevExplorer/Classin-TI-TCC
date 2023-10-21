<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'caderno_id',
        // TODO
    ];

    public function eventos()
    {
        // TODO
        // return $this->hasMany(Evento::class);
    }
}
