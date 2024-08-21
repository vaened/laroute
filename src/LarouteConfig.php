<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute;

final readonly class LarouteConfig
{
    public function __construct(private array $config)
    {
    }

    public function libraryPath(): string
    {
        return $this->config['library'] ?? 'resources/routes';
    }

    public function resourcesPath(): string
    {
        return $this->config['resources'];
    }

    public function modules(): array
    {
        return $this->config['modules'] ?? [];
    }
}
