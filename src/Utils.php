<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute;

use function json_encode;
use function preg_replace;
use function str_replace;

final readonly class Utils
{
    public static function jsonEncode(array $data): string
    {
        return str_replace('\/', '/', json_encode($data));
    }

    public static function removeForwardSlashes(string $fragment): string
    {
        return preg_replace('/(^\/?)|(\/?$)/', '', $fragment);
    }
}