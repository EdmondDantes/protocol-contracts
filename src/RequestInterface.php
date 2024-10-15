<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use League\Uri\Contracts\UriInterface;

interface RequestInterface
{
    public function getMethod(): string;
    
    public function getUri(): UriInterface;
    
    public function getRequestContext(): RequestContextInterface;
    
    public function getRequestContextParameters(): array;
}