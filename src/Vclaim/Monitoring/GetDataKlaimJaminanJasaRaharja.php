<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/monitoring/JasaRaharja/JnsPelayanan/{Parameter 1}/tglMulai/{Parameter 2}/tglAkhir/{Parameter 3}
 * Fungsi : Monitoring Klaim Jasa Raharja
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Jenis Pelayanan (1. Rawat Inap, 2. Rawat Jalan)
 * Parameter 2 : Tgl Mulai Pencarian (yyyy-mmdd)
 * Parameter 3 : Tgl Akhir Pencarian (yyyy-mmdd)
 */

namespace Darmageddon\RestBpjs\Vclaim\Monitoring;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataKlaimJaminanJasaRaharja extends BaseRequest
{
    public function __construct(string $service, string $jenisPelayanan, string $tanggalMulai, string $tanggalAkhir)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/monitoring/JasaRaharja/JnsPelayanan/{$jenisPelayanan}/tglMulai/{$tanggalMulai}/tglAkhir/{$tanggalAkhir}"
        );

        parent::addContentTypeJson();
    }
}
