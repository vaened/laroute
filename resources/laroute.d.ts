interface Route {
    name: string;
    uri: string;
    host?: string;
}

export interface LarouteConfig {
    rootUrl: string;
    prefix: string;
    absolute: boolean;
    routes: Array<Route>;
}

export type Parameters = { [key: string]: any } | any;

export interface RouteService {
    // Check if a route exists  for a given named route.
    // service.has('routeName')
    has(name: string): boolean;

    // Generate an url without GET parameters for a given named route.
    // service.cleanURI('routeName', [params = {}])
    cleanURI(name: string, parameters?: Parameters): string;

    // Generate an url for a given named route.
    // service.route('routeName', [params = {}])
    completeURI(name: string, parameters?: Parameters): string;
}

export function createRouteService(config: LarouteConfig): RouteService;

export default createRouteService;
