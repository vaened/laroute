<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler\Json;

use PHPUnit\Framework\Attributes\Test;

final class HostedJsonRoutesCompilerTest extends JsonCompilerTestCase
{
    #[Test]
    public function compile_hosted_routes(): void
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
                'absolute' => true,
            ],
            [
                'match'    => '/api/admin',
                'name'     => 'admin',
                'rootUrl'  => 'https://admin.aplication.com',
                'absolute' => true,
            ],
        ];
    }

    protected static function expectedRoutesFromPath(): string
    {
        return __DIR__ . '/../../routes/hosted-routes.json';
    }
}