<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute;

use Vaened\Laroute\Items\FileType;

final class LarouteConfig
{
    private static array $singleFileDefaultConfig = [];

    public function __construct(private readonly array $config)
    {
        self::$singleFileDefaultConfig = [
            'name' => 'api-routes',
            'path' => $this->libraryPath(),
        ];
    }

    public static function setSingleFileDefaultModuleName(string $name): void
    {
        self::$singleFileDefaultConfig['name'] = $name;
    }

    public static function setSingleFileDefaultOutputPath(string $path): void
    {
        self::$singleFileDefaultConfig['path'] = $path;
    }

    public function libraryPath(): string
    {
        return $this->config['library'] ?? 'resources/routes';
    }

    public function splitModulesInFiles(): bool
    {
        return $this->config['split'] ?? true;
    }

    public function defaultOutputType(): FileType
    {
        return FileType::fromString($this->config['output'] ?? 'json');
    }

    public function resourcesPath(): string
    {
        return $this->config['resources'];
    }

    public function modules(): array
    {
        return $this->config['modules'] ?? [];
    }

    public function defaultSingleFileModuleName(): string
    {
        return self::$singleFileDefaultConfig['name'];
    }

    public function defaultSingleFileOutputPath(): string
    {
        return self::$singleFileDefaultConfig['path'];
    }
}
