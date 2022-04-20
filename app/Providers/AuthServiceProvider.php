<?php

namespace App\Providers;

use App\Models\SysAdmin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
        // Auth::viaRequest('token', function ($request) {
        //     dd(auth()->user());;
        //     // dd($request);
        //     return SysAdmin::where('api_token', $request->token)->first();
        // });

    }
}
