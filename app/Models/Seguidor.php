<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;

    protected $table = 'seguidores';

    protected $fillable = [
        'seguidor_id',
        'seguido_id',
    ];

    public function seguidor()
    {
        return $this->belongsTo(User::class, 'seguidor_id');
    }

    public function seguido()
    {
        return $this->belongsTo(User::class, 'seguido_id');
    }
}
