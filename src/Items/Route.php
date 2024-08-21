<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Items;

use Illuminate\Contracts\Support\{Arrayable, Jsonable};

class Route implements Arrayable, Jsonable
{
    private array $segments;

    public function __construct(string $name, string $uri, ?string $host)
    {
        $this->segments = compact('name', 'uri', 'host');
    }

    public function toArray(): array
    {
        return $this->segments;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
