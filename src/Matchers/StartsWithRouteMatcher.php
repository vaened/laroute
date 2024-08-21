<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Matchers;

use Illuminate\Support\Str;
use Vaened\Laroute\RouteMatcher;

final readonly class StartsWithRouteMatcher implements RouteMatcher
{
    const ANY = '*';

    public function matches(string $fullUri, string $pattern): bool
    {
        return self::ANY === $pattern || Str::startsWith($fullUri, $pattern);
    }
}