<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

use IfCastle\Exceptions\LogicalException;
use Psr\Http\Message\UriInterface as PsrUri;

class Request                       implements RequestInterface,
                                               RequestParametersMutableInterface,
                                               HeadersMutableInterface
{
    use HeadersMutableTrait;
    
    protected string $method;
    protected PsrUri $uri;
    protected RequestContextInterface $requestContext;
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
    public function getUri(): PsrUri
    {
        return $this->uri;
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
    public function getRequestParameters(): array
    {
        return $this->parameters;
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
    
    /**
     * @throws LogicalException
     */
    #[\Override]
    public function setRequestParameters(array $parameters): void
    {
        $this->throwIfImmutable();
        
        $this->parameters           = $parameters;
    }
    
    /**
     * @throws LogicalException
     */
    #[\Override]
    public function mergeRequestParameter(array $parameters): void
    {
        $this->throwIfImmutable();
        
        $this->parameters           = array_merge($this->parameters, $parameters);
    }
    
    /**
     * @throws LogicalException
     */
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
}