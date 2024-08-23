<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute;

use Vaened\Laroute\Items\Module;
use Vaened\Support\Types\ArrayList;
use Vaened\Support\Types\SecureList;

final class Modules extends SecureList
{
    static public function type(): string
    {
        return Module::class;
    }

    public function matches(): ArrayList
    {
        return $this->map(fn(Module $module) => $module->match());
    }
}
