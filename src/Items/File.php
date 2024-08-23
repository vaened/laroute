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
        private string    $name,
        private string    $path,
        private FileType  $type,
        private ArrayList $routes
    )
    {
    }

    public static function from(Module $module, ArrayList $routes): self
    {
        return new self($module->name(), $module->path(), $module->output(), $routes);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function type(): FileType
    {
        return $this->type;
    }

    public function routes(): ArrayList
    {
        return $this->routes;
    }
}