<?php

declare(strict_types=1);

namespace Darmageddon\RestBpjs\Vclaim\RequestBody;

use Darmageddon\RestBpjs\RequestBody;

class InsertLPKRequestBody extends RequestBody
{
    private array $diagnosa;
    private array $procedure;

    public function __construct()
    {
        $this->diagnosa = [];

        $this->procedure = [];

        $this->body = [
            "request" => [
                "t_lpk" => [
                    "noSep" => "",
                    "tglMasuk" => "",
                    "tglKeluar" => "",
                    "jaminan" => "",
                    "poli" => [
                        "poli" => ""
                    ],
                    "perawatan" => [
                        "ruangRawat" => "",
                        "kelasRawat" => "",
                        "spesialistik" => "",
                        "caraKeluar" => "",
                        "kondisiPulang" => "",
                    ],
                    "diagnosa" => [],
                    // "diagnosa" => [
                    //     //["kode" => "", "level" => ""],
                    // ],
                    "procedure" => [],
                    // "procedure" => [
                    //     //["kode" => ""]
                    // ],
                    "rencanaTL" => [
                        "tindakLanjut" => "",
                        "dirujukKe" => [
                            "kodePPK" => ""
                        ],
                        "kontrolKembali" => [
                            "tglKontrol" => "",
                            "poli" => "",
                        ],
                    ],
                    "DPJP" => "",
                    "user" => "",
                ],
            ],
        ];
    }

    public function setNoSEP(string $noSEP): self
    {
        $this->body['request']['t_lpk']['noSep'] = $noSEP;

        return $this;
    }

    public function setTanggal(string $tanggalMasuk, string $tanggalKeluar): self
    {
        $this->body['request']['t_lpk']['tglMasuk'] = $tanggalMasuk;
        $this->body['request']['t_lpk']['tglKeluar'] = $tanggalKeluar;

        return $this;
    }

    public function setJaminan(string $jaminan): self
    {
        $this->body['request']['t_lpk']['jaminan'] = $jaminan;

        return $this;
    }

    public function setPoli(string $poli): self
    {
        $this->body['request']['t_lpk']['poli'] = [
            "poli" => $poli
        ];

        return $this;
    }

    public function setRuangRawat(string $ruangRawat): self
    {
        $this->body['request']['t_lpk']['perawatan']['ruangRawat'] = $ruangRawat;

        return $this;
    }

    public function setKelasRawat(string $kelasRawat): self
    {
        $this->body['request']['t_lpk']['perawatan']['kelasRawat'] = $kelasRawat;

        return $this;
    }

    public function setSpesialistik(string $spesialistik): self
    {
        $this->body['request']['t_lpk']['perawatan']['spesialistik'] = $spesialistik;

        return $this;
    }

    public function setCaraKeluar(string $caraKeluar): self
    {
        $this->body['request']['t_lpk']['perawatan']['caraKeluar'] = $caraKeluar;

        return $this;
    }

    public function setKondisiPulang(string $kondisiPulang): self
    {
        $this->body['request']['t_lpk']['perawatan']['kondisiPulang'] = $kondisiPulang;

        return $this;
    }

    public function setDiagnosa(string $kode, string $level): self
    {
        $this->diagnosa[] = [
            "kode" => $kode,
            "level" => $level
        ];

        $this->body['request']['t_lpk']['diagnosa'] = $this->diagnosa;

        return $this;
    }

    public function clearDiagnosa(): self
    {
        $this->diagnosa[] = [];

        $this->body['request']['t_lpk']['diagnosa'] = $this->diagnosa;

        return $this;
    }

    public function setProcedure(string $kode): self
    {
        $this->procedure[] = [
            "kode" => $kode
        ];

        $this->body['request']['t_lpk']['procedure'] = $this->procedure;

        return $this;
    }

    public function clearProcedure(): self
    {
        $this->procedure[] = [];

        $this->body['request']['t_lpk']['procedure'] = $this->procedure;

        return $this;
    }

    public function setTindakLanjut(string $tindakLanjut): self
    {
        $this->body['request']['t_lpk']['rencanaTL']['tindakLanjut'] = $tindakLanjut;

        return $this;
    }

    public function setDirujukKe(string $kodePPK): self
    {
        $this->body['request']['t_lpk']['rencanaTL']['dirujukKe']["kodePPK"] = $kodePPK;

        return $this;
    }

    public function setKontrolKembali(string $tglKontrol, string $poli): self
    {
        $this->body['request']['t_lpk']['rencanaTL']['kontrolKembali']["tglKontrol"] = $tglKontrol;
        $this->body['request']['t_lpk']['rencanaTL']['kontrolKembali']["poli"] = $poli;

        return $this;
    }

    public function setDPJP(string $dpjp): self
    {
        $this->body['request']['t_lpk']['DPJP'] = $dpjp;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->body['request']['t_lpk']['user'] = $user;

        return $this;
    }
}
