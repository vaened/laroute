<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute;

use Vaened\Laroute\Exporters\RouteServiceExporter;
use Vaened\Laroute\Exporters\RoutesFileExporter;

final readonly class Publisher
{
    public function __construct(
        private RouteServiceExporter $routeServiceExporter,
        private RoutesFileExporter   $routesFileExporter,
    )
    {
    }

    public function publish(bool $overrideLibrary): void
    {
        $this->createLibrary($overrideLibrary);
        $this->exportRouter();
    }

    private function exportRouter(): void
    {
        $this->routesFileExporter->publish();
    }

    private function createLibrary(bool $override): void
    {
        if (!$override && $this->routeServiceExporter->isFileExists()) {
            return;
        }

        $this->routeServiceExporter->publish();
    }
}
