export function createRouteService({rootUrl, prefix, absolute, routes}) {
    const laroute = {
        create(name, parameters, options = {withQueryString: true}) {
            const route = this.getByName(name);
            const hostname = this.getHostname(route);
            const urn = this.replaceNamedParameters(route.uri, parameters);
            const qs = options.withQueryString ? this.getRouteQueryString(parameters) : "";
            return this.buildUri(hostname, urn, qs);
        },

        getByName(name) {
            const route = routes.find((route) => route.name === name);

            if (route === undefined) {
                throw new Error(`Not found route: ${name}`);
            }

            return route;
        },

        getHostname(route) {
            if (absolute) {
                return route.host === undefined ? rootUrl : `///${route.host}`;
            }
            return "";
        },

        replaceNamedParameters(uri, parameters) {
            uri = uri.replace(/{(.*?)\??}/g, (match, key) => {
                if (!parameters.hasOwnProperty(key)) {
                    return match;
                }
                const value = parameters[key];
                delete parameters[key];
                return value;
            });

            // Strip out any optional parameters that were not given
            return uri.replace(/\/{.[^}]*?\?}/g, "");
        },

        getRouteQueryString(parameters) {
            return Object.keys(parameters)
                .map((key) => `${key}=${parameters[key]}`)
                .join("&");
        },

        buildUri(hostname, urn, queryString) {
            const removeForwardSlashes = (fragment) => fragment.replace(/(^\/?)|(\/?$)/g, "");
            const notEmpty = (fragment) => fragment != null && fragment !== "";
            const fragments = [prefix, urn]
                .filter(notEmpty)
                .map(removeForwardSlashes)
                .join("/");

            return `${removeForwardSlashes(hostname)}/${fragments}${queryString ?? "?" + queryString}`;
        },

        hasRoute(name) {
            return routes.some((route) => route.name === name);
        },
    };

    return {
        // Check if a route exists  for a given named route.
        // service.has('routeName')
        has(name) {
            return laroute.hasRoute(name);
        },

        // Generate an url without GET parameters for a given named route.
        // service.cleanURI('routeName', [params = {}])
        cleanURI(name, parameters) {
            return laroute.create(name, parameters, {withQueryString: false});
        },

        // Generate an url for a given named route.
        // service.route('routeName', [params = {}])
        completeURI(name, parameters = {}) {
            return laroute.create(name, parameters, {withQueryString: true});
        },
    };
}

export default createRouteService;
