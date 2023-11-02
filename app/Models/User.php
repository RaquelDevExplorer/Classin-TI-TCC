<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\RecuperarSenha;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Sends a notification for password reset.
     *
     * @param string $token The token for password reset.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RecuperarSenha($token));
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->perfil()->create([
                'foto' => 'default.png',
                'bio' => "Oi, me chamo {$user->name}!",
            ]);

            $user->caderno()->create([]);
            $user->agenda()->create([]);
        });
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'usuario_id', 'id');
    }

    public function agenda()
    {
        return $this->hasOne(Agenda::class, 'usuario_id', 'id');
    }

    public function caderno()
    {
        return $this->hasOne(Caderno::class, 'usuario_id', 'id');
    }
}
