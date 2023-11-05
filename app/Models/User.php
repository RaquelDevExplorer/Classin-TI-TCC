<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Seguidor;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\RecuperarSenha;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function seguidos()
    {
        return $this->belongsToMany(User::class, Seguidor::class, 'seguidor_id', 'seguido_id')
                ->where('seguido_id', '!=', $this->id);
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, Seguidor::class, 'seguido_id', 'seguidor_id')
                ->where('seguidor_id', '!=', $this->id);
    }
}
