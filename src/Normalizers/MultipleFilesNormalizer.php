<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Normalizers;

use Vaened\Support\Types\ArrayList;

final readonly class MultipleFilesNormalizer implements Normalizer
{
    public function normalize(ArrayList $files): ArrayList
    {
        return $files;
    }
}