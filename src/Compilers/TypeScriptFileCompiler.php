<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Compilers;

use Illuminate\Support\Str;
use Vaened\Laroute\Items\File;

final readonly class TypeScriptFileCompiler implements Compiler
{
    public function __construct(private JsonFileCompiler $jsonFileGenerator)
    {
    }

    public function compile(File $file): string
    {
        return self::template(
            Str::studly($file->name()),
            $this->jsonFileGenerator->compile($file)
        );
    }

    public function extension(): string
    {
        return 'ts';
    }

    private static function template(string $module, string $routes): string
    {
        return <<<TS
            const routes = $routes;      
            export type {$module}RouteName = keyof typeof routes;
            export default routes;
        TS;
    }
}