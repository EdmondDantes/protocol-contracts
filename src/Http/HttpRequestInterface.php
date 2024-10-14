<?php
declare(strict_types=1);

namespace IfCastle\Protocol\Http;

use IfCastle\Async\ReadableStreamInterface;

interface HttpRequestInterface
{
    public function getMethod(): string;
    public function getParameter(string $name): ?string;
    public function getParameters(): array;
    
    public function getBodySize(): int;
    public function getBody(): string;
    
    public function getCookies(): array;
    
    public function getHeaders(): array;
    
    public function getHeader(string $name): ?array;
    
    public function getHeaderLine(string $name): ?string;
    
    public function getBodyStream(): ?ReadableStreamInterface;
}