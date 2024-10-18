<?php
declare(strict_types=1);

namespace IfCastle\Protocol;

interface RequestParametersMutableInterface extends RequestParametersInterface, \IfCastle\DesignPatterns\Immutable\ImmutableInterface
{
    public function setRequestParameters(array $parameters): void;
    
    public function mergeRequestParameter(array $parameters): void;
    
    public function setUploadedFiles(array $files): void;
}