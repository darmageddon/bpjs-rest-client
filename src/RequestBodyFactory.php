<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

use Darmageddon\RestBpjs\Vclaim\RequestBody\{
    InsertLPKRequestBody,
    UpdateLPKRequestBody,
    DeleteLPKRequestBody
};

class RequestBodyFactory
{
    public function createInsertLPKRequestBody(): RequestBodyInterface
    {
        return new InsertLPKRequestBody();
    }

    public function createUpdateLPKRequestBody(): RequestBodyInterface
    {
        return new UpdateLPKRequestBody();
    }

    public function createDeleteLPKRequestBody(): RequestBodyInterface
    {
        return new DeleteLPKRequestBody();
    }
}
