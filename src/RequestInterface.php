<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

interface RequestInterface
{
    public function getRequestContext(): RequestContextInterface;
    public function getRequestContextParameters(): array;
}