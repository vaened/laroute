<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Compilers;

use Vaened\Laroute\Items\File;
use Vaened\Laroute\Items\Route;
use Vaened\Laroute\Utils;

final readonly class JsonFileCompiler implements Compiler
{
    public function compile(File $file): string
    {
        return Utils::jsonEncode($file->routes()->reduce(self::serialize(...), []));
    }

    public function extension(): string
    {
        return 'json';
    }

    private static function serialize(array $acc, Route $route): array
    {
        return [
            ...$acc,
            $route->name() => $route->primitives(),
        ];
    }
}