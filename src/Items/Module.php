<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Items;

use Illuminate\Contracts\Support\{Arrayable, Jsonable};
use Vaened\Support\Types\ArrayList;

use function ltrim;

class Module implements Arrayable, Jsonable
{
    private ArrayList       $routes;

    private readonly string $match;

    public function __construct(
        string                  $match,
        private readonly string $rootUrl,
        private readonly string $name,
        private readonly string $prefix,
        private readonly string $path,
        private readonly bool   $absolute
    )
    {
        $this->match = ltrim($match, '/');
    }

    public function routes(): ArrayList
    {
        return $this->routes;
    }

    public function setRoutes(ArrayList $routes): void
    {
        $this->routes = $routes;
    }

    public function match(): string
    {
        return $this->match;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function toArray(): array
    {
        return [
            'rootUrl'  => $this->rootUrl,
            'prefix'   => $this->prefix,
            'absolute' => $this->absolute,
            'routes'   => $this->routes->map(self::serialize())->items(),
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    private static function serialize(): callable
    {
        return static fn(Route $route) => $route->toArray();
    }
}
