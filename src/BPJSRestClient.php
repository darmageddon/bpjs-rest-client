<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

use InvalidArgumentException;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

use Darmageddon\RestBpjs\Vclaim\VclaimRequestFactory;

/**
 * @method ResponseInterface getPesertaByNIK(string $nik, string $tglSEP)
 * @method ResponseInterface getPesertaByNoKartu(string $nokartu, string $tglSEP)
 * @method ResponseInterface getDataKunjungan(string $tanggal, string $jenisPelayanan)
 * @method ResponseInterface getDataKlaim(string $tanggal, string $jenisPelayanan, string $status)
 * @method ResponseInterface getDataHistoriPelayananPeserta(string $noKartu, string $tanggalMulai, string $tanggalAkhir)
 * @method ResponseInterface getDataKlaimJaminanJasaRaharja(string $jenisPelayanan, string $tanggalMulai, string $tanggalAkhir)
 * @method ResponseInterface insertLPK(RequestBodyInterface $body)
 * @method ResponseInterface updateLPK(RequestBodyInterface $body)
 * @method ResponseInterface deleteLPK(RequestBodyInterface $body)
 * @method ResponseInterface getDataLembarPengajuanKlaim(string $tanggalMasuk, string $jenisPelayanan)
 */
class BPJSRestClient
{
    private Client $client;

    private array $config;

    private HandlerFactory $handlerFactory;

    private RequestFactory $requestFactory;

    private RequestBodyFactory $requestBodyFactory;

    public function __construct(array $config)
    {
        $this->assertConfig($config);

        $this->config = $config;

        $this->handlerFactory = new HandlerFactory($config);
        $this->requestFactory = new RequestFactory($config);
        $this->requestBodyFactory = new RequestBodyFactory();

        $this->createClient($config['default_service']);
    }

    public function service(string $service): self
    {
        $config = [
            'services' => $this->config['services'],
            'default_service' => $service
        ];

        return new self($config);
    }

    public function __call($name, $arguments): ResponseInterface
    {
        return $this->getClient()->send(
            request: $this->requestFactory->make(
                service: $this->getService(),
                name: $name,
                arguments: $arguments
            )
        );
    }

    public function getBodyFactory(): RequestBodyFactory
    {
        return $this->requestBodyFactory;
    }

    public function getService(): string
    {
        return $this->config['default_service'];
    }

    public function getConfig(?string $service = null): array
    {
        if (!is_null($service)) {
            return array_key_exists($service, $this->config['services'])
                ? $this->config['services'][$service]
                : [];
        }

        return $this->config;
    }

    private function getClient(): Client
    {
        return $this->client;
    }

    private function createClient(string $service): void
    {
        $handler = $this->handlerFactory->make(
            service: $service
        );

        $config = [
            ...$this->config['services'][$service],
            'handler' => $handler
        ];

        $this->client = new Client(
            config: $config
        );
    }

    private function assertConfig(array $config): void
    {
        if (!isset($config['services']) || !is_array($config['services'])) {
            throw new InvalidArgumentException(
                message: 'Config key: services tidak ditemukan atau tidak valid.'
            );
        }

        if (!isset($config['default_service']) || !array_key_exists($config['default_service'], $config['services'])) {
            throw new InvalidArgumentException(
                message: 'Config key: default_service tidak ditemukan atau tidak valid.'
            );
        }

        foreach ($config['services'] as $key => $value) {
            if (!isset($value['name'])) {
                throw new InvalidArgumentException(
                    message: 'Config key: name tidak ditemukan.'
                );
            }

            if (!isset($value['base_uri'])) {
                throw new InvalidArgumentException(
                    message: 'Config key: base_uri tidak ditemukan.'
                );
            }
        }
    }
}
