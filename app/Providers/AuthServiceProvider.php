<?php

namespace App\Providers;
// use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Pouvoir customiser le lien de réinitialisation du mot de passe
        // ResetPassword::createUrlUsing(function ($user, string $token) {
        //     return 'https://example.com/reset-password?token='.$token;
        // });

        Gate::define('superuser', function() {
            
            $user_id = Auth::id();

            $user = User::find($user_id);

            foreach($user->workspaces as $workspace) {
                return $workspace->pivot->admin == 1 || $workspace->pivot->ownership == 1;
            }
        });

        // Gate::define('ownership', function($user) {

        //     $usr = Auth::id();

        //     foreach($user->workspaces as $workspace) {
        //         return $workspace->pivot->ownership == 1;
        //     }
            
        //     //$user_id = Auth::id();

        //     //$user = User::find($user_id);

        //     // foreach($user->workspaces as $workspace) {
        //     //     return $workspace->pivot->ownership == 1;
        //     //     //echo $workspace->pivot->ownership == 0;
        //     // }
        // });

        Gate::define('task_delete', function() {
            
            $user_id = Auth::id();

            $user = User::find($user_id);

            foreach($user->workspaces as $workspace) {
                return $workspace->pivot->admin == 1 || $workspace->pivot->ownership == 1 || $workspace->pivot->user_id == $user_id;
            }
        });
    }
}
