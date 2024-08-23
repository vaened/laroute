<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Items;

use function ltrim;

final readonly class Module
{
    private string   $match;

    private FileType $type;

    public function __construct(
        string          $match,
        private string  $rootUrl,
        private string  $name,
        private string  $prefix,
        private string  $path,
        FileType|string $output,
        private bool    $absolute
    )
    {
        $this->match = ltrim($match, '/');
        $this->type  = $output instanceof FileType ? $output : FileType::fromString($output);
    }

    public function match(): string
    {
        return $this->match;
    }

    public function rootUrl(): string
    {
        return $this->rootUrl;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function prefix(): string
    {
        return $this->prefix;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function output(): FileType
    {
        return $this->type;
    }

    public function absolute(): bool
    {
        return $this->absolute;
    }
}
