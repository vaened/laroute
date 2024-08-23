<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Exporters;

use Illuminate\Filesystem\Filesystem;
use Throwable;
use Vaened\Laroute\Compilers\CompilerResolver;
use Vaened\Laroute\FileRouteBuilder;
use Vaened\Laroute\Items\File;
use Vaened\Laroute\LarouteException;
use Vaened\Laroute\Normalizers\Normalizer;

use function Illuminate\Filesystem\join_paths;

final readonly class RoutesFileExporter
{
    public function __construct(
        private Normalizer       $filesNormalizer,
        private CompilerResolver $fileCompilerResolver,
        private Filesystem       $filesystem,
        private FileRouteBuilder $fileRouteBuilder,
    )
    {
    }

    public function publish(): void
    {
        $this->filesNormalizer
            ->normalize($this->fileRouteBuilder->files())
            ->each(fn(File $file) => $this->export($file));
    }

    private function export(File $file): void
    {
        $compiler = $this->fileCompilerResolver->resolveFor($file->type());

        try {
            $this->filesystem->makeDirectory($file->path(), 0755, true, true);
            $this->filesystem->put(
                self::create($file, $compiler->extension()),
                $compiler->compile($file)
            );
        } catch (Throwable $error) {
            throw LarouteException::cantExportModule($file->name(), $error);
        }
    }

    private static function create(File $file, string $extension): string
    {
        return join_paths($file->path(), "{$file->name()}.$extension");
    }
}