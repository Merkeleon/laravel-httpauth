<?php

namespace Merkeleon\Laravel\HttpAuth\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Merkeleon\Laravel\HttpAuth\Console\Commands\User\Clear as UsersClear;
use Merkeleon\Laravel\HttpAuth\Console\Commands\User\Forget as UserForget;
use Merkeleon\Laravel\HttpAuth\Console\Commands\User\Make as UserMake;
use Merkeleon\Laravel\HttpAuth\Console\Commands\User\Show as UsersShow;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist\Add as WhitelistAdd;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist\Base as WhitelistBase;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist\Clear as WhitelistClear;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist\Forget as WhitelistForget;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist\Show as WhitelistShow;
use Merkeleon\Laravel\HttpAuth\Middleware\HttpAuth;

class HttpAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->commands([
                UsersClear::class,
                UserForget::class,
                UserMake::class,
                UsersShow::class,

                WhitelistAdd::class,
                WhitelistBase::class,
                WhitelistClear::class,
                WhitelistForget::class,
                WhitelistShow::class,
            ]);
        }
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(HttpAuth::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
