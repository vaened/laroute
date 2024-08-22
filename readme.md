# Laroute

`vaened\laroute` is a PHP library inspired by [aaronlord/laroute](https://github.com/aaronlord/laroute), designed to help Laravel developers
manage their application’s routes in `JavaScript` without the need to hardcode `URLs`. This library goes a step further by introducing
modular routing, allowing you to separate
routes based on URL patterns into different modules. Each module generates its own `JSON` file, making it easier to manage and scale your
application’s routing structure.

![routes example](https://github.com/user-attachments/assets/76a24d08-fc95-40da-b30a-b642e1364ffc)

## Installation

Laravception requires PHP 8.2.
To get the latest version, simply require the project using Composer:

```bash
composer require vaened/laroute
```

Now. Publish the configuration file.

```bash
php artisan vendor:publish --tag='laroute'
```

## Features

- **Modular Routing**: Define and separate routes by modules based on URL patterns (e.g., /api, /admin, /user), with each module generating
  a separate JSON file.
- **Seamless Integration with Laravel**: Automatically generate JavaScript routes from your Laravel routes, ensuring consistency across your
  application.
- **TypeScript Support**: Includes a TypeScript-compatible JavaScript file, allowing you to use strongly-typed route definitions in your
  front-end code.
- **Customizable URLs**: Generate absolute or relative URLs with customizable prefixes and root URLs, giving you full control over how URLs
  are constructed.
- **Flexible Configuration**: Easily configure modules and route matching criteria to fit the needs of your project, whether it’s a
  monolithic application or a modular one.