<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Exporters;

use Illuminate\Filesystem\Filesystem;
use Throwable;
use Vaened\Laroute\FileRouteBuilder;
use Vaened\Laroute\Items\Module;
use Vaened\Laroute\LarouteException;

use function Illuminate\Filesystem\join_paths;

final readonly class RoutesFileExporter
{
    public function __construct(
        private Filesystem       $filesystem,
        private FileRouteBuilder $fileRouteBuilder,
    )
    {
    }

    public function publish(): void
    {
        $this->fileRouteBuilder->files()
                               ->each(fn(Module $module) => $this->export($module));
    }

    private function export(Module $module): void
    {
        try {
            $this->filesystem->makeDirectory($module->path(), 0755, true, true);
            $this->filesystem->put(self::createFileFor($module), $module->toJson());
        } catch (Throwable $error) {
            throw LarouteException::cantExportModule($module->name(), $error);
        }
    }

    private static function createFileFor(Module $module): string
    {
        return join_paths($module->path(), "{$module->name()}.json");
    }
}