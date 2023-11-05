<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caderno extends Model
{
    use HasFactory;

    protected $table = 'cadernos';

    protected $fillable = [
        'usuario_id',
    ];

    public function folhas()
    {
        return $this->hasMany(Folha::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
