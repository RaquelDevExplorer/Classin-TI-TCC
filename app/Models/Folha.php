<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folha extends Model
{
    use HasFactory;

    protected $table = 'folhas';

    protected $fillable = [
        'caderno_id',
        'caminho',
        'image',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $date = \Date::now()->format('Y-m-d_H-i-s');
            $filename = "{$date}_{$model->caderno_id}.json";
            $path = "folhas/$filename";
            $model->caminho = $path;

            \Storage::put($path, json_encode([
                'title' => 'Sem título',
                'blocks' => [
                    [
                        'html' => '<strong>Olá, Mundo!</strong>',
                        'tag' => 'p',
                        'file' => '',
                    ]
                ],
            ]));
        });
    }

    public function getFolhaJson()
    {
        return \Storage::json($this->caminho);
    }

    public function getImageAttribute(String $value)
    {
        return \Storage::url('folhas/backgrounds/' . $value);
    }
}
