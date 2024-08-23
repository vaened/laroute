<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Compilers;

use Vaened\Laroute\Items\File;

interface Compiler
{
    public function compile(File $file): string;

    public function extension(): string;
}