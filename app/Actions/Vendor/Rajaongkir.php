<?php

namespace App\Actions\Vendor;

use Illuminate\Support\Facades\Http;

class Filepond {

    private $apiKey;

    function __construct() {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function fetchProvinces()
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/province';

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($apiUrl);

        return $this->response($response);

    }

    public function fetchCities($provinceId = null)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        $prepare = Http::withHeaders([
            'key' => $this->apiKey,
        ]);

        if($provinceid) {
            $response = $prepare->get($apiUrl, ['province' => $id]);
        } else {
            $response = $prepare->get($apiUrl);
        }

        return $this->response($response);
    }

    public function fetchCost(int $destination, int $origin, int $weight, string $courier)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/cost';

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->post($apiurl, [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $this->response($response);
    }

    public function response($response)
    {
        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }

        return false;
    }

}