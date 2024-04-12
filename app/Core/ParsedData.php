<?php

namespace App\Core;

namespace App\Core;

class ParsedData
{
    private mixed $raw;
    private array $parsed;
    private array $metadata;
    private string $sourceType;
    
    public function __construct(mixed $raw, array $parsed, string $sourceType, array $metadata = [])
    {
        $this->raw = $raw;
        $this->parsed = $parsed;
        $this->sourceType = $sourceType;
        $this->metadata = $metadata;
    }
    
    public function addMetadata(string $key, mixed $value): self
    {
        $this->metadata[$key] = $value;
        return $this;
    }
    
    public function getMetadata(string $key = null): mixed
    {
        if ($key === null) {
            return $this->metadata;
        }
        
        return $this->metadata[$key] ?? null;
    }
    
    public function getParsed(): array
    {
        return $this->parsed;
    }
    
    public function getRaw(): mixed
    {
        return $this->raw;
    }
    
    public function getSourceType(): string
    {
        return $this->sourceType;
    }
    
    public function setParsed(array $parsed): self
    {
        $this->parsed = $parsed;
        return $this;
    }
}
