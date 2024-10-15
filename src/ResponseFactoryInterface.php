<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use IfCastle\Async\ReadableStreamInterface;

interface ResponseFactoryInterface
{
    public function createSuccessResponse(
        string|bool|int|float|array|null|ReadableStreamInterface $response,
        ?string                                                  $contentType = null,
        ?int                                                     $responseCode = null
    ): ResponseInterface;
    
    public function createFailedResponse(\Throwable $throwable, string $contentType = null): ResponseInterface;
}