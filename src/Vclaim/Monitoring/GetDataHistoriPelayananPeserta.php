<?php

declare(strict_types=1);
/**
 * {Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglMulai/{Parameter 2}/tglAkhir/{Parameter 3}
 * Fungsi : Histori Pelayanan Per Peserta
 * Method : GET
 * Format : Json
 * Content-Type: application/json; charset=utf-8
 * Parameter 1 : No.Kartu Peserta
 * Parameter 2 : Tgl Mulai Pencarian (yyyy-mmdd)
 * Parameter 3 : Tgl Akhir Pencarian (yyyy-mmdd)
 */

namespace Darmageddon\RestBpjs\Vclaim\Monitoring;

use Darmageddon\RestBpjs\BaseRequest;

class GetDataHistoriPelayananPeserta extends BaseRequest
{
    public function __construct(string $service, string $noKartu, string $tanggalMulai, string $tanggalAkhir)
    {
        parent::__construct(
            method: 'GET',
            uri: "{$service}/monitoring/HistoriPelayanan/NoKartu/{$noKartu}/tglMulai/{$tanggalMulai}/tglAkhir/{$tanggalAkhir}"
        );

        parent::addContentTypeJson();
    }
}
