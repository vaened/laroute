<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\Laroute\Tests\Compiler;

use Vaened\Laroute\Compilers\Compiler;
use Vaened\Laroute\FileRouteBuilder;
use Vaened\Laroute\Items\File;
use Vaened\Laroute\Normalizers\MultipleFilesNormalizer;
use Vaened\Laroute\Tests\TestCase;
use Vaened\Support\Types\ArrayList;

use function file_get_contents;
use function json_decode;

abstract class CompilerTestCase extends TestCase
{
    private ArrayList    $files;

    private static array $expectedRoutes;

    abstract protected static function compiler(): Compiler;

    abstract protected static function expectedRoutesFromPath(): string;

    protected function setUp(): void
    {
        parent::setUp();

        $filesNormalizer  = static::create(MultipleFilesNormalizer::class);
        $fileRouteBuilder = static::create(FileRouteBuilder::class);
        $this->files      = $filesNormalizer->normalize($fileRouteBuilder->files());

        self::$expectedRoutes = json_decode(file_get_contents(static::expectedRoutesFromPath()), true);
    }

    protected function files(): ArrayList
    {
        return $this->files;
    }

    protected static function getStoreRoutes(): array
    {
        return self::$expectedRoutes['store'];
    }

    protected static function getAdminRoutes(): array
    {
        return self::$expectedRoutes['admin'];
    }

    protected static function module(string $module): callable
    {
        return static fn(File $file) => $file->name() === $module;
    }
}