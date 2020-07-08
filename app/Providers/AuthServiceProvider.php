<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        //check for admin
        //return true if auth user type is admin
        $gate->define('isAdmin', function($user){
            return $user->user_type == 'admin';
        });
        //Check for author
        //Return true if auth user is author
        $gate->define('isAuthor', function($user){
            return $user->user_type == 'author';
        });
        //check for editor
        //return treu if auth user type is editor
        $gate->define('isEditor', function($user){
            return $user->user_type == 'editor';
        });
    }
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     $this->registerPolicies();

    //     //
    // }
}
