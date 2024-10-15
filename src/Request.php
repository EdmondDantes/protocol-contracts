<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use League\Uri\Contracts\UriInterface;

class Request                       implements RequestInterface,
                                               RequestParametersMutableInterface,
                                               HeadersMutableInterface,
                                               ImmutableInterface
{
    protected string $method;
    protected UriInterface $uri;
    protected RequestContextInterface $requestContext;
    protected array $headers            = [];
    protected array $parameters         = [];
    /**
     * @var array FileContainerInterface[]
     */
    protected array $uploadedFiles      = [];
    protected bool $isImmutable         = false;
    
    #[\Override]
    public function getMethod(): string
    {
        return $this->method;
    }
    
    #[\Override]
    public function getUri(): UriInterface
    {
        return $this->uri;
    }
    
    #[\Override]
    public function getHeaders(): array
    {
        return $this->headers;
    }
    
    #[\Override]
    public function hasHeader(string $name): bool
    {
        return array_key_exists(strtolower($name), $this->headers);
    }
    
    #[\Override]
    public function getHeader(string $name): array
    {
        return $this->headers[strtolower($name)] ?? [];
    }
    
    #[\Override]
    public function getHeaderLine(string $name): string
    {
        return implode(',', $this->getHeader($name));
    }
    
    #[\Override]
    public function setHeaders(array $headers): static
    {
        $this->throwIfImmutable();
        
        $this->headers              = $headers;
        return $this;
    }
    
    #[\Override]
    public function setHeader(string $header, array|string $value): static
    {
        $this->throwIfImmutable();
        
        $header                     = strtolower($header);
        
        if(false === array_key_exists($header, $this->headers)) {
            $this->headers[$header] = [];
        }
        
        if(is_array($value)) {
            $this->headers[$header] = array_merge($this->headers[$header], $value);
        } else {
            $this->headers[$header][] = $value;
        }
        
        return $this;
    }
    
    #[\Override]
    public function resetHeaders(): static
    {
        $this->throwIfImmutable();
        
        $this->headers              = [];
        return $this;
    }
    
    #[\Override]
    public function getRequestContext(): RequestContextInterface
    {
        return $this->requestContext;
    }
    
    #[\Override]
    public function getRequestContextParameters(): array
    {
        return [];
    }
    
    #[\Override]
    public function getRequestParameter(string $name): mixed
    {
        return $this->parameters[$name] ?? null;
    }
    
    #[\Override]
    public function requestParameters(string ...$names): array
    {
        $result                     = [];
        
        foreach($names as $name) {
            if(array_key_exists($name, $this->parameters)) {
                $result[$name]      = $this->parameters[$name];
            }
        }
        
        return $result;
    }
    
    #[\Override]
    public function requestParametersWithNull(string ...$names): array
    {
        $result                     = [];
        
        foreach($names as $name) {
            $result[$name]          = $this->parameters[$name] ?? null;
        }
        
        return $result;
    }
    
    #[\Override]
    public function isRequestParametersExist(string ...$names): bool
    {
        foreach($names as $name) {
            if(false === array_key_exists($name, $this->parameters)) {
                return false;
            }
        }
        
        return true;
    }
    
    #[\Override]
    public function isRequestParametersDefined(string ...$names): bool
    {
        foreach($names as $name) {
            if(null === $this->parameters[$name] ?? null) {
                return false;
            }
        }
        
        return true;
    }
    
    #[\Override]
    public function setRequestParameters(array $parameters): void
    {
        $this->throwIfImmutable();
        
        $this->parameters           = $parameters;
    }
    
    #[\Override]
    public function mergeRequestParameter(array $parameters): void
    {
        $this->throwIfImmutable();
        
        $this->parameters           = array_merge($this->parameters, $parameters);
    }
    
    #[\Override]
    public function setUploadedFiles(array $files): void
    {
        $this->throwIfImmutable();
        
        $this->uploadedFiles         = $files;
    }
    
    #[\Override]
    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles;
    }
    
    #[\Override]
    public function getUploadedFile(string $name): ?FileContainerInterface
    {
        return $this->uploadedFiles[$name] ?? null;
    }
    
    #[\Override]
    public function hasUploadedFile(string $name): bool
    {
        return array_key_exists($name, $this->uploadedFiles);
    }
    
    #[\Override]
    public function isImmutable(): bool
    {
        return $this->isImmutable;
    }
    
    #[\Override]
    public function asImmutable(): static
    {
        $this->isImmutable          = true;
        return $this;
    }
    
    protected function throwIfImmutable(): void
    {
        if($this->isImmutable) {
            throw new \LogicException('Request is immutable');
        }
    }
}