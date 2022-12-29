<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs\Vclaim;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use LZCompressor\LZString;

class Handler
{
    private HandlerStack $handlerStack;

    public function __construct(
        private string $consumerId,
        private string $consumerSecret,
        private string $userKey
    ) {
    }

    public function __invoke(): HandlerStack
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->unshift($this->createRequestHandler());
        $handlerStack->push($this->createResponseHandler());

        return $handlerStack;
    }

    private function createRequestHandler(): callable
    {
        return Middleware::mapRequest(function (RequestInterface $request) {
            $timestamp = $this->getTimestamp();

            return $request->withHeader('X-cons-id', $this->getConsumerId())
                ->withHeader('X-timestamp', $timestamp)
                ->withHeader('X-signature', $this->getSignature($timestamp))
                ->withHeader('user_key', $this->getUserKey());
        });
    }

    private function createResponseHandler(): callable
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $promise = $handler($request, $options);

                return $promise->then(
                    function (ResponseInterface $response) use ($request) {

                        return $response->withBody(
                            Utils::streamFor(
                                $this->format($request, $response)
                            )
                        );
                    }
                );
            };
        };
    }

    private function format(RequestInterface $request, ResponseInterface $response): string
    {
        $statusCode = $response->getStatusCode();
        $contents = \json_decode($response->getBody()->getContents(), true);

        if ($statusCode === 200) {

            if (isset($contents['metaData']) && $contents['metaData']['code'] === '200') {
                $timestamp = (int) $request->getHeader('X-timestamp')[0];

                $data = $this->decompressResponse(
                    $this->decryptResponse($contents['response'], $timestamp)
                );

                $contents['response'] = \json_decode($data, true);
            }
        }

        return \json_encode($contents);
    }

    private function decompressResponse(string $content): ?string
    {
        return LZString::decompressFromEncodedURIComponent($content);
    }

    private function decryptResponse(string $ciphertext, int $timestamp): ?string
    {
        $key = $this->getConsumerId() . $this->getConsumerSecret() . (string) $timestamp;
        $keyHash = hash('sha256', $key);

        $passphrase = hex2bin($keyHash);
        $iv = substr($passphrase, 0, 16);

        return openssl_decrypt(
            base64_decode($ciphertext),
            'aes-256-cbc',
            $passphrase,
            OPENSSL_RAW_DATA,
            $iv
        );
    }

    private function getSignature(int $timestamp): string
    {
        $signature = hash_hmac(
            'sha256',
            $this->getConsumerId() . "&" . (string) $timestamp,
            $this->getConsumerSecret(),
            true
        );
        return base64_encode($signature);
    }

    private function getTimestamp(): int
    {
        return time();
    }

    private function getConsumerId(): string
    {
        return $this->consumerId;
    }

    private function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    private function getUserKey(): string
    {
        return $this->userKey;
    }
}
