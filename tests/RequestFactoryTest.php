<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use PHPUnit\Framework\TestCase;
use Darmageddon\RestBpjs\RequestFactory;

final class RequestFactoryTest extends TestCase
{
    private RequestFactory $factory;

    protected function setUp(): void
    {
        $config = [
            'services' => [
                'vclaim' => [
                    'name' => 'vclaim-rest-dev',
                    // other config
                ]
            ]
        ];
        $this->factory = new RequestFactory($config);
    }

    public function testGetDataPRBByNomorSRB(): void
    {
        // $client->getDataPRBByNomorSRB('NO_SRB', 'NO_SEP')
        $request = $this->factory->make('vclaim', 'getDataPRBByNomorSRB', ['NO_SRB', 'NO_SEP']);

        $this->assertTrue($request instanceof Request);
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('vclaim-rest-dev/prb/NO_SRB/nosep/NO_SEP', (string) $request->getUri());
    }

    public function testGetDataPRBByTanggalSRB(): void
    {
        // $client->getDataPRBByTanggalSRB('2022-12-12', '2022-12-31')
        $request = $this->factory->make('vclaim', 'getDataPRBByTanggalSRB', ['2022-12-12', '2022-12-31']);

        $this->assertTrue($request instanceof Request);
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('vclaim-rest-dev/prb/tglMulai/2022-12-12/tglAkhir/2022-12-31', (string) $request->getUri());
    }
}
