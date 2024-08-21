<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Illuminate\Support\ServiceProvider;
use Vaened\Laroute\Console\Command\LarouteGenerateCommand;
use Vaened\Laroute\Matchers\StartsWithRouteMatcher;

use function config;

final class LarouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            LarouteConfig::class,
            static fn() => new LarouteConfig([
                ...config('laroute', []),
                'resources' => __DIR__ . '/../resources',
            ])
        );

        $this->app->singleton(
            RouteMatcher::class,
            StartsWithRouteMatcher::class
        );

        $this->commands([
            LarouteGenerateCommand::class,
        ]);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laroute.php' => config_path('laroute.php'),
            ], 'laroute');
        }
    }
}
