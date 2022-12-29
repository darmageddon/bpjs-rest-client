<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/LPK/update
 * Fungsi : Update Rujukan
 * Method : PUT
 * Format : Json
 * Content-Type: Application/x-www-form-urlencoded
 */

namespace Darmageddon\RestBpjs\Vclaim\Lpk;

use Darmageddon\RestBpjs\BaseRequest;
use Darmageddon\RestBpjs\RequestBodyInterface;

class UpdateLPK extends BaseRequest
{
    public function __construct(string $service, RequestBodyInterface $body)
    {
        parent::__construct(
            method: 'PUT',
            uri: "{$service}/LPK/update",
            headers: [],
            body: $body
        );

        parent::addContentTypeForm();
    }
}
