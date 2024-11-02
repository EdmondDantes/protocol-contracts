<?php

declare(strict_types=1);

namespace IfCastle\Protocol\Http\Exceptions;

interface HttpErrorInterface
{
    public function getStatusCode(): int;

    public function getReasonPhrase(): string|null;
}
