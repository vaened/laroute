<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Illuminate\Filesystem\Filesystem;
use Throwable;
use Vaened\Laroute\Items\Module;

use function Illuminate\Filesystem\join_paths;

final readonly class Publisher
{
    public function __construct(
        private Filesystem         $filesystem,
        private ModuleRouteBuilder $moduleRouteBuilder,
        private LarouteConfig      $config,
    )
    {
    }

    public function publish(bool $overrideLibrary): void
    {
        $this->createLibrary($overrideLibrary);
        $this->moduleRouteBuilder->modules()->each(fn(Module $module) => $this->export($module));
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

    private function createLibrary(bool $override): void
    {
        $libraryService = join_paths($this->config->libraryPath(), 'laroute.js');

        if (!$override && $this->filesystem->exists($libraryService)) {
            return;
        }

        try {
            $this->filesystem->makeDirectory($this->config->libraryPath(), 0755, true, true);

            $this->filesystem->put(
                join_paths($this->config->libraryPath(), 'laroute.js'),
                $this->filesystem->get(join_paths($this->config->resourcesPath(), 'laroute.js'))
            );
            $this->filesystem->put(
                join_paths($this->config->libraryPath(), 'laroute.d.ts'),
                $this->filesystem->get(join_paths($this->config->resourcesPath(), 'laroute.d.ts'))
            );
        } catch (Throwable $error) {
            throw LarouteException::cantOverrideLibrary($error);
        }
    }

    private static function createFileFor(Module $module): string
    {
        return join_paths($module->path(), "{$module->name()}.json");
    }
}
