<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\ExpenseItem;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use App\Models\Purchase;
use App\Models\PurchasesDetail;
use App\Models\RevenueItem;
use App\Models\Supplier;
use App\Models\SysAdmin;
use App\Observers\AdminObserver;
use App\Observers\CustomerObserver;
use App\Observers\CustomerOrderObserver;
use App\Observers\EmployeeObserver;
use App\Observers\ExpenseItemObserver;
use App\Observers\OrderObserver;
use App\Observers\ProviderProductObserver;
use App\Observers\PurchaseObserver;
use App\Observers\PurchasesDetailObserver;
use App\Observers\RevenueItemObserver;
use App\Observers\SupplierObserver;
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
        SysAdmin::observe(AdminObserver::class);
        CustomerOrder::observe(CustomerOrderObserver::class);
        Purchase::observe(PurchaseObserver::class);
        PurchasesDetail::observe(PurchasesDetailObserver::class);
        RevenueItem::observe(RevenueItemObserver::class);
        ExpenseItem::observe(ExpenseItemObserver::class);
        Supplier::observe(SupplierObserver::class);
        Customer::observe((CustomerObserver::class));
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
