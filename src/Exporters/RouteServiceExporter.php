<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Exporters;

use Illuminate\Filesystem\Filesystem;
use Throwable;
use Vaened\Laroute\LarouteConfig;
use Vaened\Laroute\LarouteException;

use function Illuminate\Filesystem\join_paths;

final readonly class RouteServiceExporter
{
    public function __construct(
        private Filesystem    $filesystem,
        private LarouteConfig $config,
    )
    {
    }

    public function publish(): void
    {
        try {
            $this->filesystem->makeDirectory($this->config->libraryPath(), 0755, true, true);

            $this->filesystem->put(
                join_paths($this->config->libraryPath(), 'laroute.js'),
                $this->filesystem->get(join_paths($this->config->resourcesPath(), 'laroute.stub'))
            );
            $this->filesystem->put(
                join_paths($this->config->libraryPath(), 'laroute.d.ts'),
                $this->filesystem->get(join_paths($this->config->resourcesPath(), 'laroute.d.stub'))
            );
        } catch (Throwable $error) {
            throw LarouteException::cantOverrideLibrary($error);
        }
    }

    public function isFileExists(): bool
    {
        $libraryService = join_paths($this->config->libraryPath(), 'laroute.js');
        return $this->filesystem->exists($libraryService);
    }
}