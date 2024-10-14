<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

interface ImmutableInterface
{
    public function isImmutable(): bool;
    
    public function asImmutable(): static;
}