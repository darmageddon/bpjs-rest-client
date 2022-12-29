<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use PHPUnit\Framework\TestCase;
use Darmageddon\RestBpjs\BPJSRestClient;
use Darmageddon\RestBpjs\RequestBodyInterface;

final class BPJSRestClientTest extends TestCase
{
    private array $config;

    protected function setUp(): void
    {
        $this->config = [
            'services' => [
                'vclaim' => [
                    'name' => 'vclaim-rest-dev',
                    'base_uri' => 'https://apijkn-dev.bpjs-kesehatan.go.id',
                    'consumer_id' => '1234',
                    'consumer_secret' => '1234567890',
                    'user_key' => '12345678123456781234567812345678',
                    'debug' => true
                ],
                'vclaim-test' => [
                    'name' => 'vclaim-rest-dev',
                    'base_uri' => 'https://apijkn-dev.bpjs-kesehatan.go.id',
                    'consumer_id' => 'CONSUMER_ID',
                    'consumer_secret' => 'SECRET',
                    'user_key' => 'KEY',
                    'debug' => true
                ],
            ],
            'default_service' => 'vclaim',
        ];
    }

    public function test_can_create_client(): void
    {
        $client = new BPJSRestClient($this->config);
        $this->assertSame('vclaim', $client->getService());
    }

    public function test_can_create_client_using_service_function(): void
    {
        $client = new BPJSRestClient($this->config);
        $clientTest = $client->service('vclaim-test');
        $this->assertSame('vclaim', $client->getService());
        $this->assertSame('vclaim-test', $clientTest->getService());
    }

    public function test_is_config_valid(): void
    {
        $client = new BPJSRestClient($this->config);
        $this->assertArrayHasKey('services', $client->getConfig());
        $this->assertArrayHasKey('name', $client->getConfig('vclaim'));

        // client aplicares belum diimplementasi
        // config masih kosong
        $this->assertSame([], $client->getConfig('aplicares'));
    }

    public function test_can_create_request_body_using_factory(): void
    {
        $client = new BPJSRestClient($this->config);
        $body = $client->getBodyFactory()->createInsertLPKRequestBody();
        $this->assertTrue($body instanceof RequestBodyInterface);
        $this->assertArrayHasKey('request', $body->toArray());
    }

    public function test_expect_exception_without_valid_credential(): void
    {
        $client = new BPJSRestClient($this->config);

        // Testing invalid credential
        try {
            $response = $client->getPesertaByNIK('1234563112709999', '2022-12-12');
            // Expect {"metaData":{"code":"201","message":"No.Kartu Tidak Sesuai"},"response":null}
            $json = json_decode($response->getBody()->getContents());
            $this->assertSame("201", $json->metaData->code);

        } catch (ClientException $exception) {
            $request = $exception->getRequest();
            $this->assertTrue($request->hasHeader('X-cons-id'));
            $this->assertTrue($request->hasHeader('X-timestamp'));
            $this->assertTrue($request->hasHeader('X-signature'));
            $this->assertTrue($request->hasHeader('user_key'));

            $this->assertTrue($exception->hasResponse());
            $this->assertSame(403, $exception->getResponse()->getStatusCode());
        } catch (ConnectException $exception) {
            $this->assertSame(
                'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nik/1234563112709999/tglSEP/2022-12-12',
                (string) $exception->getRequest()->getUri()
            );
        }
    }
}
