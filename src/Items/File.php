<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Items;

use Vaened\Support\Types\ArrayList;

final readonly class File
{
    public function __construct(
        private Module    $module,
        private ArrayList $routes
    )
    {
    }

    public function module(): Module
    {
        return $this->module;
    }

    public function routes(): ArrayList
    {
        return $this->routes;
    }
}