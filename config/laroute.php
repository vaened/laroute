<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Library Path
    |--------------------------------------------------------------------------
    |
    | Specifies the directory where the main JavaScript library will be
    | published. This is the location where the library or service that will
    | use the exported routes will be saved. The generated files containing
    | the routes will be used by this library, typically within your application's
    | resources directory.
    |
    */
    'library' => 'resources/routes',

    /*
    |--------------------------------------------------------------------------
    | Split Routes into Multiple Files
    |--------------------------------------------------------------------------
    |
    | This option controls whether the routes for each module should be
    | generated into separate files, or if all routes should be
    | combined into a single file.
    |
    | true  - Creates a separate JSON file for each module. The file name
    |         will be the same as the module's name (e.g., 'store.{json, ts}',
    |         'admin.{json, ts}').
    |
    | false - Combines all routes from all modules into a single file
    |         named 'api-routes.{json, ts}'.
    |
    */
    'split'   => true,

    /*
    |--------------------------------------------------------------------------
    | Output Format
    |--------------------------------------------------------------------------
    |
    | This option specifies the format of the route files. Supported formats
    | are 'json' and 'typescript'. By default, this setting applies to all
    | modules. If a specific module has its own 'output' configuration, that
    | value will override this default for that module.
    |
    | json  - Generates route files in JSON format.
    | ts    - Generates route files in TypeScript format.
    |
    */
    'output'  => 'json',

    /*
    |--------------------------------------------------------------------------
    | Modules Configuration
    |--------------------------------------------------------------------------
    |
    | Define the configuration for each module. Each module has its own set of
    | routes and settings for generating the corresponding routes file.
    |
    */
    'modules' => [
        [
            /*
            |--------------------------------------------------------------------------
            | Route Matching Criteria
            |--------------------------------------------------------------------------
            |
            | Specify which routes should be included. Use '*' to include all routes,
            | or provide a specific path to match (e.g., '/api') to filter routes.
            |
            */
            'match'    => '*',

            /*
            |--------------------------------------------------------------------------
            | Module Name
            |--------------------------------------------------------------------------
            |
            | The name of the module and the resulting JSON file. This will be used
            | to identify the module within your application.
            |
            */
            'name'     => 'api',

            /*
            |--------------------------------------------------------------------------
            | Root URL
            |--------------------------------------------------------------------------
            |
            | This URL is used as the base for generating absolute URLs when 'absolute'
            | is set to true. If 'absolute' is true, the value of 'rootUrl' will be used.
            | If 'rootUrl' is not defined, the value will fall back to the APP_URL environment
            | variable defined in your .env file. If neither is set, URLs will not be absolute.
            |
            */
            'rootUrl'  => env('APP_URL', 'http://localhost'),

            /*
            |--------------------------------------------------------------------------
            | Absolute URLs
            |--------------------------------------------------------------------------
            |
            | If set to true, absolute URLs will be generated. The base URL used for these
            | absolute URLs is determined by the 'rootUrl' setting. If 'rootUrl' is not set,
            | the value of the APP_URL environment variable will be used. If 'absolute' is
            | false, relative URLs will be generated.
            |
            */
            'absolute' => true,

            /*
            |--------------------------------------------------------------------------
            | URL Prefix
            |--------------------------------------------------------------------------
            |
            | Here you may specify a prefix that will be added to all generated URLs.
            | By default, this value is an empty string, meaning no prefix will be added.
            |
            */
            'prefix'   => null,

            /*
            |--------------------------------------------------------------------------
            | Destination Path
            |--------------------------------------------------------------------------
            |
            | This value determines the path where the generated routes file will be
            | stored. Typically, this will be within your resources' directory.
            |
            */
            'path'     => 'resources/routes',
        ],
    ]
];
