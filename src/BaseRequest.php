<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs;

use GuzzleHttp\Psr7\Request;

abstract class BaseRequest
{
    private string $method;

    private string $uri;

    private array $headers;

    private ?RequestBodyInterface $body;

    public function __construct(string $method, string $uri, array $headers = [], ?RequestBodyInterface $body = null)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function __invoke(): Request
    {
        return new Request(
            method: $this->getMethod(),
            uri: $this->getUri(),
            headers: $this->getHeaders(),
            body: $this->getBody()
        );
    }

    protected function addContentTypeJson(): self
    {
        $this->addHeader('Content-Type', 'application/json; charset=utf-8');

        return $this;
    }

    protected function addContentTypeForm(): self
    {
        $this->addHeader('Content-Type', 'application/x-www-form-urlencoded');

        return $this;
    }

    protected function addHeader(string $key, mixed $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    protected function getMethod(): string
    {
        return $this->method;
    }

    protected function getUri(): string
    {
        return $this->uri;
    }

    protected function getHeaders(): array
    {
        return $this->headers;
    }

    protected function getBody(): ?RequestBodyInterface
    {
        return $this->body;
    }
}
