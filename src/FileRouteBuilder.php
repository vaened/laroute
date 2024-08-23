<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Closure;
use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Routing\Router as LaravelRouter;
use Vaened\Laroute\Items\{File, Module};
use Vaened\Laroute\Items\Route;
use Vaened\Support\Types\AbstractList;
use Vaened\Support\Types\ArrayList;

final readonly class ModuleRouteBuilder
{
    private ArrayList $laravelRoutes;

    public function __construct(
        LaravelRouter           $router,
        private ModulesProvider $provider,
        private RouteMatcher    $matcher,
    )
    {
        $this->laravelRoutes = new ArrayList($router->getRoutes()->getRoutes());
    }

    public function files(): ArrayList
    {
        $routes          = $this->laravelRoutes->filter($this->onlyNamed());
        $modules         = $this->provider->modules();
        $matches         = $modules->matches();
        $routeCollection = $matches->reduce($this->pair($routes), new ArrayList(AbstractList::Empty));

        return $this->provider->modules()
                              ->map(self::toRoutesFile($routeCollection));
    }

    private function onlyNamed(): Closure
    {
        return fn(LaravelRoute $route): bool => $route->getName() != null;
    }

    private function pair(ArrayList $routes): callable
    {
        return function (ArrayList $acc, string $match) use ($routes) {
            $filtered = $routes->filter(
                fn(LaravelRoute $route) => $this->matcher->matches($route->uri(), $match)
            );

            $acc->push($filtered, $match);
            return $acc;
        };
    }

    private static function toRoutesFile(ArrayList $routeCollection): callable
    {
        return function (Module $module) use ($routeCollection): File {
            $routes = $routeCollection->pick(self::matchedWith($module));

            return new File(
                $module,
                $routes->map(self::createRouteFor($module))
            );
        };
    }

    private static function createRouteFor(Module $module): Closure
    {
        return fn(LaravelRoute $route): Route => new Route(
            $route->getName(),
            $module->rootUrl(),
            $route->uri(),
            $module->prefix(),
            $module->absolute(),
            $route->domain()
        );
    }

    private static function matchedWith(Module $module): callable
    {
        return static fn(ArrayList $routes, string $prefix) => $prefix === $module->match();
    }
}
