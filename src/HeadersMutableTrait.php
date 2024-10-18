<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use IfCastle\DesignPatterns\Immutable\ImmutableTrait;
use IfCastle\Exceptions\LogicalException;

trait HeadersMutableTrait
{
    use ImmutableTrait;
    use HeadersTrait;
    
    /**
     * @throws LogicalException
     */
    public function setHeaders(array $headers): static
    {
        $this->throwIfImmutable();
        
        foreach ($headers as $header) {
            $this->setHeader($header, $header);
        }
        
        return $this;
    }
    
    /**
     * @throws LogicalException
     */
    public function setHeader(string $header, string|array $value): static
    {
        $this->throwIfImmutable();
        
        $this->headers[$header]     = is_array($value) ? $value : [$value];
        
        return $this;
    }
    
    /**
     * @throws LogicalException
     */
    public function resetHeaders(): static
    {
        $this->throwIfImmutable();
        
        $this->headers              = [];
        return $this;
    }
}