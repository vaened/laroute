<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Builder;

use Vaened\Laroute\Items\Module;
use Vaened\Laroute\ModuleRouteBuilder;
use Vaened\Laroute\Tests\TestCase;

abstract class ModuleBuilderTestCase extends TestCase
{
    protected function builtModules(): array
    {
        $builder = self::create(ModuleRouteBuilder::class);
        return $builder->modules()->map(fn(Module $module) => $module->toArray())->items();
    }
}