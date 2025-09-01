<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Gate pour vérifier si l'utilisateur est admin
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });
        
        // Gate pour vérifier si l'utilisateur est coach
        Gate::define('is-coach', function ($user) {
            return $user->role === 'coach';
        });
        
        // Gate pour vérifier si l'utilisateur est coach ou admin
        Gate::define('is-staff', function ($user) {
            return in_array($user->role, ['admin', 'coach']);
        });
        
        // Gate pour vérifier si l'utilisateur peut modifier une équipe
        Gate::define('manage-equipe', function ($user, $equipe) {
            if ($user->role === 'admin') {
                return true;
            }
            
            return $user->role === 'coach' && $user->id === $equipe->user_id;
        });
    }
}
