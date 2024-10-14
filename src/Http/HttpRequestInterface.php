<?php
declare(strict_types=1);

namespace IfCastle\Protocol\Http;

use IfCastle\Async\ReadableStreamInterface;
use IfCastle\Protocol\HeadersInterface;
use IfCastle\Protocol\RequestParametersInterface;

interface HttpRequestInterface extends HeadersInterface, RequestParametersInterface
{
    public function getMethod(): string;
    public function getCookies(): array;
    
    public function getBodySize(): int;
    public function getBody(): string;
    
    public function getBodyStream(): ?ReadableStreamInterface;
}