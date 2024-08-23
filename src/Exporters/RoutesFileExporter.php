<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Exporters;

use Illuminate\Filesystem\Filesystem;
use Throwable;
use Vaened\Laroute\FileRouteBuilder;
use Vaened\Laroute\Items\File;
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
                               ->each(fn(File $file) => $this->export($file));
    }

    private function export(File $file): void
    {
        try {
            $this->filesystem->makeDirectory($file->module()->path(), 0755, true, true);
            $this->filesystem->put(self::createFileFor($file->module()), $file->module()->toJson());
        } catch (Throwable $error) {
            throw LarouteException::cantExportModule($file->module()->name(), $error);
        }
    }

    private static function createFileFor(Module $module): string
    {
        return join_paths($module->path(), "{$module->name()}.json");
    }
}