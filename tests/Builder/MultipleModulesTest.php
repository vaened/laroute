<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Builder;

use PHPUnit\Framework\Attributes\Test;

final class MultipleModulesTest extends ModuleBuilderTestCase
{
    #[Test]
    public function generate_with_multiple_modules_configuration(): void
    {
        $modules = $this->builtModules();

        $this->assertCount(2, $modules);

        $this->assertSame([
            self::store(),
            self::admin(),
        ], $modules);
    }

    protected static function modules(): array
    {
        return [
            [
                'match'    => '/api/store',
                'name'     => 'store',
                'rootUrl'  => 'https://store.aplication.com',
                'absolute' => true,
                'prefix'   => '',
                'path'     => 'resources/routes',
            ],
            [
                'match'    => '/api/admin',
                'name'     => 'admin',
                'rootUrl'  => 'https://admin.aplication.com',
                'absolute' => true,
                'prefix'   => '',
                'path'     => 'resources/routes',
            ],
        ];
    }

    private static function store(): array
    {
        return [
            "rootUrl"  => "https://store.aplication.com",
            "prefix"   => "",
            "absolute" => true,
            "routes"   => [
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
            ],
        ];
    }

    private static function admin(): array
    {
        return [
            "rootUrl"  => "https://admin.aplication.com",
            "prefix"   => "",
            "absolute" => true,
            "routes"   => [
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
            ],
        ];
    }
}