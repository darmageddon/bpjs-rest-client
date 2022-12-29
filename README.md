![BPJS Kesehatan](.github/rest-bpjs.png?raw=true)


# BPJS REST Client

Sebuah client REST BPJS yang simpel menggunakan PHP 8.

[![Tests](https://github.com/darmageddon/bpjs-rest-client/actions/workflows/php.yml/badge.svg)](https://github.com/darmageddon/bpjs-rest-client/actions/workflows/php.yml)

## Usage/Examples

```php
use Darmageddon\RestBpjs\BPJSRestClient;

$config = [
    'services' => [
        'vclaim' => [
            'name' => 'vclaim-rest-dev',
            'base_uri' => 'https://apijkn-dev.bpjs-kesehatan.go.id',
            'consumer_id' => 'CONSUMER_ID',
            'consumer_secret' => 'CONSUMER_SECRET',
            'user_key' => 'USER_KEY',
            'debug' => false
        ],
        // service lain
    ],
    'default_service' => 'vclaim'
];

$client = new BPJSRestClient($config);
```

Menggunakan client dengan service selain default_service. (Pastikan service terdapat pada config)

```php
use Darmageddon\RestBpjs\BPJSRestClient;

$client = new BPJSRestClient($config);

$clientAplicares = $client->service("aplicares");

```

Contoh: mencari peserta berdasarkan NIK pada service VClaim

```php
try {
    $response = $client->getPesertaByNIK('1234563112709999', '2022-12-12');
    $json = json_decode($response->getBody()->getContents());

} catch (ClientException $exception) {
    //
} catch (ConnectException $exception) {
    //
} catch (\Throwable $exception) {
    //
}
```

Contoh: Insert Lembar Pengajuan Klaim (LPK)

```php
try {
    // Membuat request body dengan Factory
    $body = $client->getBodyFactory()->createInsertLPKRequestBody();
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

    // Insert LPK menggunakan request body $body
    $response = $client->insertLPK($body);
    $json = json_decode($response->getBody()->getContents());

} catch (ClientException $exception) {
    //
} catch (ConnectException $exception) {
    //
} catch (\Throwable $exception) {
    //
}
```

## Features (VClaim)

- [x] Lembar Pengajuan Klaim
- [x] Monitoring
- [x] Peserta
- [ ] Pembuatan Rujuk Balik (PRB)
- [ ] Pencarian Data PRB
- [ ] Referensi
- [ ] Pembuatan Rencana Kontrol/SPRI
- [ ] Cari Rujukan
- [ ] Pembuatan Rujukan
- [ ] Pembuatan SEP
- [ ] Potensi Suplesi Jasa Raharja
- [ ] Approval Penjaminan SEP
- [ ] Update Tgl Pulang SEP
- [ ] Integrasi SEP dan Inacbg
- [ ] SEP Internal
- [ ] Finger Print


## Roadmap

- Menambahkan endpoint-endpoint lain pada service VClaim

- Menambahkan service lain, seperti: Aplicares, Antrean RS, Apotek, PCare

