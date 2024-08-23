<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler\Json;

use PHPUnit\Framework\Attributes\Test;

final class PrefixedJsonRoutesCompilerTest extends JsonCompilerTestCase
{
    #[Test]
    public function compile_prefixed_routes(): void
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
                'prefix'   => 'store-name',
                'absolute' => false,
            ],
            [
                'match'    => '/api/admin',
                'name'     => 'admin',
                'prefix'   => 'dashboard',
                'absolute' => false,
            ],
        ];
    }

    protected static function expectedRoutesFromPath(): string
    {
        return __DIR__ . '/../../routes/prefixed-routes.json';
    }
}