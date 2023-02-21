<?php

namespace App\Providers;

use App\Actions\Contracts\UpdatesUserProfileInformation;
use App\Actions\UpdateUserProfileInformation;
use App\Models\Debtor;
use App\Models\User;
use App\Observers\DebtorObserver;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UpdatesUserProfileInformation::class, function ($app) {
            return new UpdateUserProfileInformation();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Debtor::observe(DebtorObserver::class);
    }
}
