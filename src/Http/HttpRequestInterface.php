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
    
    /**
     * The method retrieves the HTTP FORM from the request if possible.
     * That is, the method checks the Content Type,
     * and if it matches one of the specified options: application/x-www-form-urlencoded or form-data,
     * the method returns a form object.
     *
     * @return HttpRequestForm|null
     */
    public function retrieveRequestForm(): HttpRequestForm|null;
}