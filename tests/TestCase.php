<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests;

use Illuminate\Contracts\Container\BindingResolutionException;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Vaened\Laroute\LarouteServiceProvider;

use function app;

abstract class TestCase extends BaseTestCase
{
    abstract protected static function modules(): array;

    protected function getEnvironmentSetUp($app): void
    {
        $app->make('config')
            ->set('laroute.modules', static::modules());
    }

    protected function getPackageProviders($app): array
    {
        return [
            LarouteServiceProvider::class,
        ];
    }

    protected function defineRoutes($router): void
    {
        $router->group(['prefix' => 'api'], function ($router) {
            $router->group(['prefix' => 'store/products'], function ($router) {
                $router->get('/', static fn() => [])->name('store.products.list');
            });

            $router->group(['prefix' => 'store/cart'], function ($router) {
                $router->get('/', static fn() => [])->name('store.cart.show');
                $router->patch('{product_id}', static fn() => [])->name('store.cart.add');
                $router->delete('{product_id}', static fn() => [])->name('store.cart.remove');
            });

            $router->group(['prefix' => 'admin/products'], function ($router) {
                $router->post('{id}', static fn() => [])->name('admin.products.create');
                $router->patch('{id}', static fn() => [])->name('admin.products.update');
                $router->get('{id}', static fn() => [])->name('admin.products.show');
            });

            $router->group(['prefix' => 'admin/users'], function ($router) {
                $router->get('/', static fn() => [])->name('admin.users.list');
                $router->post('{id}', static fn() => [])->name('admin.users.create');
                $router->patch('{id}', static fn() => [])->name('admin.users.update');
            });
        });
    }

    /**
     * @template T
     * @param class-string<T> $service
     *
     * @return T
     * @throws BindingResolutionException
     */
    protected static function create(string $service): mixed
    {
        return app()->make($service);
    }
}
