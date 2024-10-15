<?php
declare(strict_types=1);

namespace IfCastle\Protocol\Http;

final readonly class HttpRequestForm
{
    public function __construct(
        public array $get           = [],
        public array $post          = [],
        public array $files         = [],
    ) {}
}