<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Builder;

use PHPUnit\Framework\Attributes\Test;

final class SingleModuleTest extends ModuleBuilderTestCase
{
    #[Test]
    public function generate_with_configuration_of_a_single_module(): void
    {
        $modules = $this->builtModules();

        $this->assertCount(1, $modules);
        $this->assertSame([
            [
                "rootUrl"  => "http://localhost",
                "prefix"   => "",
                "absolute" => true,
                "routes"   => self::loadedRoutes(),
            ],
        ], $modules);
    }

    protected static function modules(): array
    {
        return [
            [
                'match'    => '*',
                'name'     => 'api',
                'rootUrl'  => 'http://localhost',
                'absolute' => true,
                'prefix'   => '',
                'path'     => 'resources/routes',
            ]
        ];
    }

    private static function loadedRoutes(): array
    {
        return [
            [
                "name" => "store.products.list",
                "uri"  => "api/store/products",
                "host" => null,
            ],
            [
                "name" => "store.cart.show",
                "uri"  => "api/store/cart",
                "host" => null,
            ],
            [
                "name" => "store.cart.add",
                "uri"  => "api/store/cart/{product_id}",
                "host" => null,
            ],
            [
                "name" => "store.cart.remove",
                "uri"  => "api/store/cart/{product_id}",
                "host" => null,
            ],
            [
                "name" => "admin.products.create",
                "uri"  => "api/admin/products/{id}",
                "host" => null,
            ],
            [
                "name" => "admin.products.update",
                "uri"  => "api/admin/products/{id}",
                "host" => null,
            ],
            [
                "name" => "admin.products.show",
                "uri"  => "api/admin/products/{id}",
                "host" => null,
            ],
            [
                "name" => "admin.users.list",
                "uri"  => "api/admin/users",
                "host" => null,
            ],
            [
                "name" => "admin.users.create",
                "uri"  => "api/admin/users/{id}",
                "host" => null,
            ],
            [
                "name" => "admin.users.update",
                "uri"  => "api/admin/users/{id}",
                "host" => null,
            ],
        ];
    }
}