<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Normalizers;

use Vaened\Laroute\Items\File;
use Vaened\Laroute\LarouteConfig;
use Vaened\Support\Types\ArrayList;

final readonly class SingleFileNormalizer implements Normalizer
{
    public function __construct(
        private LarouteConfig $config,
    )
    {
    }

    public function normalize(ArrayList $files): ArrayList
    {
        return new ArrayList([
            new File(
                $this->config->defaultSingleFileModuleName(),
                $this->config->defaultSingleFileOutputPath(),
                $this->config->defaultOutputType(),
                $files->flatMap(static fn(File $file) => $file->routes())
            )
        ]);
    }
}