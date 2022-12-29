<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

use GuzzleHttp\Psr7\Request;
use Darmageddon\RestBpjs\Vclaim\{
    Peserta\GetPesertaByNIK,
    Peserta\GetPesertaByNoKartu,
    Monitoring\GetDataKunjungan,
    Monitoring\GetDataKlaim,
    Monitoring\GetDataHistoriPelayananPeserta,
    Monitoring\GetDataKlaimJaminanJasaRaharja,

    Lpk\InsertLPK,
    Lpk\UpdateLPK,
    Lpk\DeleteLPK,
    Lpk\GetDataLembarPengajuanKlaim,

    PRB\GetDataPRBByNomorSRB,
    PRB\GetDataPRBByTanggalSRB
};

class RequestFactory
{
    private array $methods = [
        'vclaim' => [
            // Peserta
            GetPesertaByNIK::class,
            GetPesertaByNoKartu::class,

            // Monitoring
            GetDataKunjungan::class,
            GetDataKlaim::class,
            GetDataHistoriPelayananPeserta::class,
            GetDataKlaimJaminanJasaRaharja::class,

            // Lembar Pengajuan Klaim (LPK)
            InsertLPK::class,
            UpdateLPK::class,
            DeleteLPK::class,
            GetDataLembarPengajuanKlaim::class,

            //Pencarian Data PRB
            GetDataPRBByNomorSRB::class,
            GetDataPRBByTanggalSRB::class
        ]
    ];

    public function __construct(
        private array $config
    ) {
    }

    public function make(string $service, string $name, array $arguments): Request
    {
        // [service]-dev (for testing)
        $service = str_replace('-test', '', $service);

        if (array_key_exists($service, $this->methods)) {
            $classes = $this->getClassList(
                array: $this->methods[$service]
            );

            if (array_key_exists($name, $classes)) {
                $serviceName = $this->config['services'][$service]['name'];
                $request = new $classes[$name]($serviceName, ...$arguments);
                return $request();
            }
        }

        throw new \BadMethodCallException("Method $name tidak tersedia.");
    }

    private function getClassList(array $array): array
    {
        return array_reduce(
            array: $array,
            callback: function ($array, $class) {
                $fragments = explode('\\', $class);
                $classname = end($fragments);
                $array[lcfirst($classname)] = $class;
                return $array;
            },
            initial: []
        );
    }
}
