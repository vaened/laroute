<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler\Json;

use PHPUnit\Framework\Attributes\Test;

final class LargeJsonRoutesCompilerTest extends JsonCompilerTestCase
{
    #[Test]
    public function compile_large_routes(): void
    {
        $this->assertStoreRoutes(self::getStoreRoutes());
        $this->assertAdminRoutes(self::getAdminRoutes());
    }

    protected static function modules(): array
    {
        return [
            [
                'match'    => '/api/store',
                'name'     => 'store',
                'rootUrl'  => 'https://store.aplication.com',
                'prefix'   => 'store-name',
                'absolute' => true,
            ],
            [
                'match'    => '/api/admin',
                'name'     => 'admin',
                'rootUrl'  => 'https://admin.aplication.com',
                'prefix'   => 'dashboard',
                'absolute' => true,
            ],
        ];
    }

    protected static function expectedRoutesFromPath(): string
    {
        return __DIR__ . '/../../routes/large-routes.json';
    }
}