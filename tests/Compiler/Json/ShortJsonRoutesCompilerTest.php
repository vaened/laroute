<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler\Json;

use PHPUnit\Framework\Attributes\Test;

final class ShortJsonRoutesCompilerTest extends JsonCompilerTestCase
{
    #[Test]
    public function compile_short_routes(): void
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
                'absolute' => false,
            ],
            [
                'match'    => '/api/admin',
                'name'     => 'admin',
                'absolute' => false,
            ],
        ];
    }

    protected static function expectedRoutesFromPath(): string
    {
        return __DIR__ . '/../../routes/short-routes.json';
    }
}