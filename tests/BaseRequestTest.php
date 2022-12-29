<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use PHPUnit\Framework\TestCase;
use Darmageddon\RestBpjs\BaseRequest;

final class BaseRequestTest extends TestCase
{
    public function test_can_create_base_request()
    {
        $mockBaseRequest = $this->getMockForAbstractClass(
            originalClassName: BaseRequest::class,
            arguments: [
                'GET',
                'test/123',
                [],
                null
            ],
        );
        $request = $mockBaseRequest();

        $this->assertTrue($request instanceof Request);
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('test/123', (string) $request->getUri());
    }
}
