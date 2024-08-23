export type Name = string;

interface Route {
    uri: string;
    host: string | null;
}

export interface LarouteConfig {
    routes: Record<Name, Route>;
}

export type Parameters = Record<string, any>;

export interface RouteService<T extends Name> {
    // Check if a route exists  for a given named route.
    // service.has('routeName')
    has(name: T): boolean;

    // Generate an url without GET parameters for a given named route.
    // service.cleanURI('routeName', [params = {}])
    cleanURI(name: T, parameters?: Parameters): string;

    // Generate an url for a given named route.
    // service.route('routeName', [params = {}])
    completeURI(name: T, parameters?: Parameters): string;
}

export function createRouteService<T extends Name = string>(config: LarouteConfig): RouteService<T>;

export default createRouteService;
