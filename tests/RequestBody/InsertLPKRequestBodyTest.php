<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Darmageddon\RestBpjs\Vclaim\RequestBody\InsertLPKRequestBody;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

final class InsertLPKRequestBodyTest extends TestCase
{
    public function test_can_create_insert_LPK_request_body()
    {
        $sample = <<<SAMPLE
        {
            "request": {
                "t_lpk": {
                    "noSep": "0301R0011017V000015",
                    "tglMasuk": "2017-10-30",
                    "tglKeluar": "2017-10-30",
                    "jaminan": "1",
                    "poli": {
                        "poli": "INT"
                    },
                    "perawatan": {
                        "ruangRawat": "1",
                        "kelasRawat": "1",
                        "spesialistik": "1",
                        "caraKeluar": "1",
                        "kondisiPulang": "1"
                    },
                    "diagnosa": [
                        {
                            "kode": "N88.0",
                            "level": "1"
                        },
                        {
                            "kode": "A00.1",
                            "level": "2"
                        }
                    ],
                    "procedure": [
                        {
                            "kode": "00.82"
                        },
                        {
                            "kode": "00.83"
                        }
                    ],
                    "rencanaTL": {
                        "tindakLanjut": "1",
                        "dirujukKe": {
                            "kodePPK": ""
                        },
                        "kontrolKembali": {
                            "tglKontrol": "2017-11-10",
                            "poli": ""
                        }
                    },
                    "DPJP": "3",
                    "user": "Coba Ws"
                }
            }
        }
        SAMPLE;

        $body = new InsertLPKRequestBody();
        $body
            ->setNoSEP('0301R0011017V000015')
            ->setTanggal('2017-10-30', '2017-10-30')
            ->setJaminan('1')
            ->setPoli('INT')
            ->setRuangRawat('1')
            ->setKelasRawat('1')
            ->setSpesialistik('1')
            ->setCaraKeluar('1')
            ->setKondisiPulang('1')
            // diagnosa
            ->setDiagnosa('N88.0', '1')
            ->setDiagnosa('A00.1', '2')
            // procedur
            ->setProcedure('00.82')
            ->setProcedure('00.83')
            ->setTindakLanjut('1')
            ->setDirujukKe('')
            ->setKontrolKembali('2017-11-10', '')
            ->setDPJP('3')
            ->setUser('Coba Ws');

        $array = json_decode($sample, true);
        $this->assertEquals($array, $body->toArray());
        $this->assertEquals(json_encode($array), $body->toJson());
    }
}
