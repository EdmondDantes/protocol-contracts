<?php

declare(strict_types=1);

namespace IfCastle\Protocol;

interface HeadersMutableInterface extends HeadersInterface, \IfCastle\DesignPatterns\Immutable\ImmutableInterface
{
    public function setHeaders(array $headers): static;

    public function setHeader(string $header, string|array $value): static;

    public function resetHeaders(): static;
}
