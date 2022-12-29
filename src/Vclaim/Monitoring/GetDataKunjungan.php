<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/Monitoring/Kunjungan/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}
 * Fungsi : Data Kunjungan
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : Tanggal SEP format: yyyy-mm-dd
 * Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
 */

namespace Darmageddon\RestBpjs\Vclaim\Monitoring;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataKunjungan extends BaseRequest
{
    public function __construct(string $service, string $tanggal, string $jenisPelayanan)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/Monitoring/Kunjungan/Tanggal/{$tanggal}/JnsPelayanan/{$jenisPelayanan}"
        );

        parent::addContentTypeJson();
    }
}
