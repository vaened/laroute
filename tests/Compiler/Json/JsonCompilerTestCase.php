<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler\Json;

use Vaened\Laroute\Compilers\Compiler;
use Vaened\Laroute\Compilers\JsonFileCompiler;
use Vaened\Laroute\Tests\Compiler\CompilerTestCase;
use Vaened\Laroute\Utils;

abstract class JsonCompilerTestCase extends CompilerTestCase
{
    protected function assertStoreRoutes(array $routes): void
    {
        $store = $this->files()->pick(self::module('store'));

        $this->assertEquals(
            Utils::jsonEncode($routes),
            $this->compiler()->compile($store)
        );
    }

    protected function assertAdminRoutes(array $routes): void
    {
        $admin = $this->files()->pick(self::module('admin'));
        $this->assertEquals(
            Utils::jsonEncode($routes),
            $this->compiler()->compile($admin)
        );
    }

    protected static function compiler(): Compiler
    {
        return self::create(JsonFileCompiler::class);
    }

    protected static function config(): array
    {
        return [
            'output' => 'json',
        ];
    }
}