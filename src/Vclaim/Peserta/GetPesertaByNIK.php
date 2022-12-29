<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/Peserta/nik/{parameter 1}/tglSEP/{parameter 2}
 * Fungsi : Pencarian data peserta berdasarkan NIK Kependudukan
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : NIK KTP
 * Parameter 2 : Tanggal Pelayanan/SEP - format : yyyy-MM-dd
 */

namespace Darmageddon\RestBpjs\Vclaim\Peserta;

use Darmageddon\RestBpjs\BaseRequest;

class GetPesertaByNIK extends BaseRequest
{
    public function __construct(string $service, string $nik, string $tglSEP)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/Peserta/nik/{$nik}/tglSEP/{$tglSEP}"
        );

        parent::addContentTypeJson();
    }
}
