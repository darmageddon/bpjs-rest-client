<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs\Vclaim\RequestBody;

use Darmageddon\RestBpjs\RequestBody;

class DeleteLPKRequestBody extends RequestBody
{
    public function __construct()
    {
        $this->body = [
            "request" => [
                "t_lpk" => [
                    "noSep" => ""
                ]
            ]
        ];
    }

    public function setNoSEP(string $noSEP): self
    {
        $this->body['request']['t_lpk']['noSep'] = $noSEP;

        return $this;
    }
}
