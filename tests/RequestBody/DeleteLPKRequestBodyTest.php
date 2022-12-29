<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Darmageddon\RestBpjs\Vclaim\RequestBody\DeleteLPKRequestBody;

final class DeleteLPKRequestBodyTest extends TestCase
{
    public function test_can_create_delete_LPK_request_body()
    {
        $sample = <<<SAMPLE
        {
            "request": {
                "t_lpk": {
                    "noSep": "0301R0011017V000015"
                }
            }
        }
        SAMPLE;

        $body = new DeleteLPKRequestBody();
        $body->setNoSEP('0301R0011017V000015');

        $array = json_decode($sample, true);
        $this->assertEquals($array, $body->toArray());
        $this->assertEquals(json_encode($array), $body->toJson());
    }
}
