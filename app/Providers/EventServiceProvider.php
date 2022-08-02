<?php

namespace App\Providers;

use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use App\Observers\AdminObserver;
use App\Observers\EmployeeObserver;
use App\Observers\ProviderProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Provider::observe(AdminObserver::class);
        ProviderProduct::observe(ProviderProductObserver::class);
        ProvidersEmployee::observe(EmployeeObserver::class);
        // parent::boot();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
