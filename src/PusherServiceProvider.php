<?php
/**
 * This is NOT a freeware, use is subject to license terms
 */
declare(strict_types=1);

namespace Larva\Pusher;

use Illuminate\Support\ServiceProvider;

class PusherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Forge::class, function () {
            $config = $this->app['config']['services']['ws'];
            return new Forge($config['base_url'], $config['api_key']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}