<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/prb/{Parameter 1}/nosep/{Parameter 2}
 * Fungsi : Pencarian data PRB (Rujuk Balik) Berdasarkan Nomor SRB
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : No. SRB Peserta
 * Parameter 2 : No. SEP
 */

namespace Darmageddon\RestBpjs\Vclaim\PRB;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataPRBByNomorSRB extends BaseRequest
{
    public function __construct(string $service, string $noSrb, string $noSep)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/prb/{$noSrb}/nosep/{$noSep}"
        );

        parent::addContentTypeJson();
    }
}
