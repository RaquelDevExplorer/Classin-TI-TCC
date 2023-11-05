<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{

    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'usuario_id',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
