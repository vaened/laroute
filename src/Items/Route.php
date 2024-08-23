<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Items;

use function array_filter;

readonly class Route
{
    public function __construct(
        private string  $name,
        private string  $rootUrl,
        private string  $uri,
        private ?string $prefix,
        private bool    $absolute,
        private ?string $host
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function host(): string
    {
        return $this->absolute ? self::removeForwardSlashes($this->host ?? $this->rootUrl) : '';
    }

    public function uri(): string
    {
        $segments = array_filter([
            self::removeForwardSlashes($this->prefix),
            self::removeForwardSlashes($this->uri)
        ]);

        return implode('/', $segments);
    }

    public function primitives(): array
    {
        return [
            'host' => $this->host(),
            'uri'  => $this->uri(),
        ];
    }

    private static function removeForwardSlashes(string $fragment): string
    {
        return preg_replace('/(^\/?)|(\/?$)/', '', $fragment);
    }
}
