<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

abstract class RequestBody implements RequestBodyInterface
{
    protected array $body;

    public function toArray(): array
    {
        return $this->body;
    }

    public function toJson(): string
    {
        return \json_encode($this->body);
    }
}
