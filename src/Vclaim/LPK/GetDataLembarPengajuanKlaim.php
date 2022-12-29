<?php

declare(strict_types=1);
/**
 * {BASE URL}/{Service Name}/LPK/TglMasuk/{Parameter 1}/JnsPelayanan/{Paramater 2}
 * Fungsi : Pencarian data peserta berdasarkan NIK Kependudukan
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Tanggal Masuk - format : yyyy-MM-dd
 * Parameter 2 : Jenis Pelayanan 1. Inap 2. Jalan
 */

namespace Darmageddon\RestBpjs\Vclaim\Lpk;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataLembarPengajuanKlaim extends BaseRequest
{
    public function __construct(string $service, string $tanggalMasuk, string $jenisPelayanan)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/LPK/TglMasuk/{$tanggalMasuk}/JnsPelayanan/{$jenisPelayanan}"
        );

        parent::addContentTypeJson();
    }
}
