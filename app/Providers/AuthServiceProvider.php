<?php
namespace App\Providers;

use App\Models\Adverts;
use App\Policies\AdvertsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Adverts::class => AdvertsPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
