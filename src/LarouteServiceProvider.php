<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Vaened\Laroute\Console\Command\LarouteGenerateCommand;
use Vaened\Laroute\Matchers\StartsWithRouteMatcher;
use Vaened\Laroute\Normalizers\MultipleFilesNormalizer;
use Vaened\Laroute\Normalizers\Normalizer;
use Vaened\Laroute\Normalizers\SingleFileNormalizer;

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
            Normalizer::class,
            function (Application $application) {
                $config = $application->make(LarouteConfig::class);
                return $config->splitModulesInFiles()
                    ? new MultipleFilesNormalizer()
                    : new SingleFileNormalizer($config);
            }
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
