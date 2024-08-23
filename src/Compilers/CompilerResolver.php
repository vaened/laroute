<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Compilers;

use Vaened\Laroute\Items\FileType;

final readonly class CompilerResolver
{
    public function resolveFor(FileType $type): Compiler
    {
        return match ($type) {
            FileType::TypeScript => new TypeScriptFileCompiler(new JsonFileCompiler()),
            FileType::Json => new JsonFileCompiler(),
        };
    }
}