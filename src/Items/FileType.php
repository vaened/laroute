<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Items;

use Vaened\Laroute\LarouteException;

enum FileType: string
{
    case TypeScript = 'ts';

    case Json = 'json';

    public static function fromString(string $type): self
    {
        return FileType::tryFrom($type) ?? throw LarouteException::unsupportedOutputType($type);
    }
}
