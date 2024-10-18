<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use IfCastle\Async\ReadableStreamInterface;
use IfCastle\TypeDefinitions\ResultInterface;
use IfCastle\TypeDefinitions\Value\ValueContainerInterface;

interface ResponseFactoryInterface
{
    public function createSuccessResponse(
        string|bool|int|float|array|null|ReadableStreamInterface $response,
        ?string                                                  $contentType = null,
        ?int                                                     $responseCode = null
    ): ResponseInterface;
    
    public function createFailedResponse(\Throwable $throwable, string $contentType = null): ResponseInterface;
    
    public function createResponse(ResultInterface|ValueContainerInterface|\Throwable $result): ResponseInterface;
}