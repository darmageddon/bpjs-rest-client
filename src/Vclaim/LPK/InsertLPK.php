<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/LPK/insert
 * Fungsi : Insert Rujukan
 * Method : POST
 * Format : Json
 * Content-Type: Application/x-www-form-urlencoded
 */

namespace Darmageddon\RestBpjs\Vclaim\Lpk;

use Darmageddon\RestBpjs\BaseRequest;
use Darmageddon\RestBpjs\RequestBodyInterface;

class InsertLPK extends BaseRequest
{
    public function __construct(string $service, RequestBodyInterface $body)
    {
        parent::__construct(
            method: 'POST',
            uri: "{$service}/LPK/insert",
            headers: [],
            body: $body
        );

        parent::addContentTypeForm();
    }
}
