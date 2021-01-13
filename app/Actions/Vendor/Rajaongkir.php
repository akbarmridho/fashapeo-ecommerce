<?php

namespace App\Actions\Vendor;

use Illuminate\Support\Facades\Http;
use App\Actions\Address\ActiveOriginAddress;

class Rajaongkir {

    use ActiveOriginAddress;

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

    public function fetchCities($provinceId = null, $cityId = null)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        $prepare = Http::withHeaders([
            'key' => $this->apiKey,
        ]);

        if($provinceid) {
            $response = $prepare->get($apiUrl, ['province' => $id]);
        } else if ($cityId) {
            $response = $prepare->get($apiUrl, ['id' => $cityId]);
        } else {
            $response = $prepare->get($apiUrl);
        }

        return $this->response($response);
    }

    public function fetchCost(int $destination, int $weight, string $courier)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/cost';

        $origin = $this->retreiveActiveOrigin()->rajaongkir_id;

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

    public function fetchAddress(int $cityId)
    {
        if (! $data = $this->fetchCities(null, $cityId)) {
            return false;
        }
        
        return [
            'city' => $data['type'] . ' ' . $data['city_name'],
            'province' => $data['province'],
            'rajaongkir_id' => $data['city_id'],
        ];
    }

    private function response($response)
    {
        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }

        return false;
    }

}