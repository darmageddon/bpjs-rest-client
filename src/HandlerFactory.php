<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

use GuzzleHttp\HandlerStack;
use Darmageddon\RestBpjs\Vclaim\Handler as VclaimHandler;

class HandlerFactory
{
    public function __construct(
        private array $config
    ) {
    }

    public function make(string $service): ?HandlerStack
    {
        $service = str_replace('-test', '', $service);

        switch ($service) {
            case 'vclaim':
                return $this->createHandlerVclaim(
                    credentials: $this->config['services'][$service]
                );

            case 'aplicares':
            case 'antrean':
            case 'pcare':
                // add here (not supported yet)
            default:
                return null;
        }
    }

    private function createHandlerVclaim(array $credentials): HandlerStack
    {
        $handler = new VclaimHandler(
            consumerId: $credentials['consumer_id'],
            consumerSecret: $credentials['consumer_secret'],
            userKey: $credentials['user_key'],
        );
        return $handler();
    }
}
