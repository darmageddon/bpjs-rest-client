<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

interface RequestBodyInterface
{
    public function toArray(): array;

    public function toJson(): string;
}
