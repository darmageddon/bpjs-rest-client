<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/Monitoring/Klaim/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}/Status/{Parameter 3}
 * Fungsi : Data Klaim
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Tanggal Pulang format: yyyy-mm-dd
 * Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
 * Parameter 3 : Status Klaim (1. Proses Verifikasi 2. Pending Verifikasi 3. Klaim)
 */

namespace Darmageddon\RestBpjs\Vclaim\Monitoring;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataKlaim extends BaseRequest
{
    public function __construct(string $service, string $tanggal, string $jenisPelayanan, string $status)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/Monitoring/Klaim/Tanggal/{$tanggal}/JnsPelayanan/{$jenisPelayanan}/Status/{$status}"
        );

        parent::addContentTypeJson();
    }
}
