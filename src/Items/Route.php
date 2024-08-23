<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Items;

use Vaened\Laroute\Utils;

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
        return $this->absolute ? Utils::removeForwardSlashes($this->host ?? $this->rootUrl) : '';
    }

    public function uri(): string
    {
        $segments = array_filter([
            Utils::removeForwardSlashes($this->prefix),
            Utils::removeForwardSlashes($this->uri)
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
}
