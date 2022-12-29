<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/prb/tglMulai{Parameter 1}/tglAkhir{Parameter 2}
 * Fungsi : Pencarian data PRB (Rujuk Balik) Berdasarkan Tanggal SRB
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Tgl. Mulai (yyyy-mm-dd)
 * Parameter 2 : Tgl. Mulai (yyyy-mm-dd)
 */

namespace Darmageddon\RestBpjs\Vclaim\PRB;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataPRBByTanggalSRB extends BaseRequest
{
    public function __construct(string $service, string $tanggalMulai, string $tanggalAkhir)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/prb/tglMulai/{$tanggalMulai}/tglAkhir/{$tanggalAkhir}"
        );

        parent::addContentTypeJson();
    }
}
