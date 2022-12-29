<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/Peserta/nokartu/{parameter 1}/tglSEP/{parameter 2}
 * Fungsi : Pencarian data peserta BPJS Kesehatan
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Nomor Kartu
 * Parameter 2 : Tanggal Pelayanan/SEP - format : yyyy-MM-dd
 */

namespace Darmageddon\RestBpjs\Vclaim\Peserta;

use Darmageddon\RestBpjs\BaseRequest;

class GetPesertaByNoKartu extends BaseRequest
{
    public function __construct(string $service, string $nokartu, string $tglSEP)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/Peserta/nokartu/{$nokartu}/tglSEP/{$tglSEP}"
        );

        parent::addContentTypeJson();
    }
}
