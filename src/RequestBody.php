<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

abstract class RequestBody implements RequestBodyInterface
{
    protected array|string $body;

    public function toArray(): array
    {
        return is_array($this->body) ? $this->body : [$this->body];
    }

    public function toJson(): string
    {
        return \json_encode($this->body);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
