<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/LPK/delete
 * Fungsi : Delete Rujukan
 * Method : DELETE
 * Format : Json
 * Content-Type: Application/x-www-form-urlencoded
 */

namespace Darmageddon\RestBpjs\Vclaim\Lpk;

use Darmageddon\RestBpjs\BaseRequest;
use Darmageddon\RestBpjs\RequestBodyInterface;

class DeleteLPK extends BaseRequest
{
    public function __construct(string $service, RequestBodyInterface $body)
    {
        parent::__construct(
            method: 'DELETE',
            uri: "{$service}/LPK/delete",
            headers: [],
            body: $body
        );

        parent::addContentTypeForm();
    }
}
