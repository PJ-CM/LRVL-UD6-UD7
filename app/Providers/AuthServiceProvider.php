<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Definiendo una regla de nombre 'isAdmin' que verifica
        //si el $user actualmente autenticado tiene un perfil
        //de tipo 'admin', devolviendo true/false
        Gate::define('isAdmin', function ($user) {
            return $user->perfil == 'admin';
        });
        //Lo mismo que la anterior pero considerando si es
        //un usuario de perfil 'author'
        Gate::define('isAuthor', function ($user) {
            return $user->perfil == 'author';
        });
        //Lo mismo que la anterior pero considerando si es
        //un usuario de perfil 'user'
        Gate::define('isUser', function ($user) {
            return $user->perfil == 'user';
        });
    }
}
