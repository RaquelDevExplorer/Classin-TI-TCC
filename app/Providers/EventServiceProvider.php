<?php

namespace App\Providers;

use App\Events\PostCurtido;
use App\Events\EventoProximo;
use App\Events\PostComentado;
use App\Events\UsuarioSeguido;
use App\Listeners\SendPostCurtido;
use App\Listeners\SendEventoProximo;
use App\Listeners\SendPostComentado;
use App\Listeners\SendUsuarioSeguido;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EventoProximo::class => [
            SendEventoProximo::class,
        ],

        PostComentado::class => [
            SendPostComentado::class,
        ],

        PostCurtido::class => [
            SendPostCurtido::class,
        ],

        UsuarioSeguido::class => [
            SendUsuarioSeguido::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
