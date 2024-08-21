<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute;

interface RouteMatcher
{
    public function matches(string $fullUri, string $pattern): bool;
}