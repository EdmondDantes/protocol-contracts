<?php

declare(strict_types=1);

namespace IfCastle\Protocol;

use Psr\Http\Message\UriInterface as PsrUri;

interface RequestInterface
{
    public function getMethod(): string;

    public function getUri(): PsrUri;

    public function getRequestContext(): RequestContextInterface;

    /**
     * @return array<string, mixed>
     */
    public function getRequestContextParameters(): array;
}
