<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Closure;
use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Routing\Router as LaravelRouter;
use Vaened\Laroute\Items\{Module};
use Vaened\Laroute\Items\Route;
use Vaened\Support\Types\AbstractList;
use Vaened\Support\Types\ArrayList;

final readonly class ModuleRouteBuilder
{
    const ANY = '*';

    private ArrayList $laravelRoutes;

    public function __construct(
        LaravelRouter           $router,
        private ModulesProvider $provider,
        private RouteMatcher    $matcher,
    )
    {
        $this->laravelRoutes = new ArrayList($router->getRoutes()->getRoutes());
    }

    public function modules(): ArrayList
    {
        $routes          = $this->laravelRoutes->filter($this->onlyNamed());
        $modules         = $this->provider->modules();
        $matches         = $modules->matches();
        $routeCollection = $matches->reduce($this->pair($routes), new ArrayList(AbstractList::Empty));

        return $this->provider->modules()->map(self::attach($routeCollection));
    }

    private function onlyNamed(): Closure
    {
        return fn(LaravelRoute $route): bool => $route->getName() != null;
    }

    private function pair(ArrayList $routes): callable
    {
        return function (ArrayList $acc, string $match) use ($routes) {
            $filtered = $match === self::ANY
                ? $routes
                : $routes->filter(fn(LaravelRoute $route) => $this->matcher->matches($route->uri(), $match));

            $acc->push($filtered, $match);
            return $acc;
        };
    }

    private static function attach(ArrayList $routeCollection): callable
    {
        return function (Module $module) use ($routeCollection) {
            $routes = $routeCollection->pick(self::matchedWith($module));
            $module->setRoutes($routes->map(self::toRoute()));

            return $module;
        };
    }

    private static function toRoute(): Closure
    {
        return fn(LaravelRoute $route): Route => new Route($route->getName(), $route->uri(), $route->domain());
    }

    private static function matchedWith(Module $module): callable
    {
        return static fn(ArrayList $routes, string $prefix) => $prefix === $module->match();
    }
}
