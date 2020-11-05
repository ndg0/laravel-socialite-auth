<?php

namespace Ndg0\LaravelSocialiteAuth;

use Illuminate\Support\ServiceProvider;

class LaravelSocialiteAuthServiceProvider extends ServiceProvider
{
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\Google\\GoogleExtendSocialite@handle',
        ],
    ];

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lsa.php', 'lsa');
    }

    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-socialite-auth.php' => config_path('laravel-socialite-auth.php'),
        ], 'laravel-socialite-auth.config');
    }
}
