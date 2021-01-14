<?php

namespace App\Repository\Vendor;

use Illuminate\Support\Facades\Http;

class RajaongkirRepository
{
    private $apiKey;
    private $http;

    function __construct() {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
        $this->http = Http::retry(3, 500)->withHeaders([
            'key' => $this->apiKey,
        ]);
    }

    public function provinces(bool $array = false)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/province';

        $response = $this->http->get($apiUrl);

        if($array) {
            return $this->arrayResponse($response);
        }

        return $this->JSONResponse($response);
    }

    public function cities($provinceId = null, bool $array = false)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        if($provinceid) {
            $response = $this->http->get($apiUrl, ['province' => $id]);
        } else {
            $response = $this->http->get($apiUrl);
        }

        if($array) {
            return $this->arrayResponse($response);
        }

        return $this->JSONResponse($response);
    }

    public function cost(int $destination, int $origin, int $weight, string $courier, bool $array = false)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/cost';

        $response = $this->http->post($apiurl, [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        if($array) {
            return $this->arrayResponse($response);
        }

        return $this->JSONResponse($response);
    }

    public function address(int $cityId)
    {
        $data = $this->http->get($apiUrl, ['id' => $cityId]);

        if (! $data->successful()) {
            return false;
        }
        
        return [
            'city' => $data['type'] . ' ' . $data['city_name'],
            'province' => $data['province'],
            'vendor_id' => $data['city_id'],
        ];
    }

    private function JSONResponse($response)
    {
        if ($response->successful())
        {
            return response()->json(
                ['results' => $response->json()['rajaongkir']['results']], 200
            );
        }
        else if ($response->clientError())
        {
            return response()->json(['message' => 'An error occured'], 400);
        }
        else if ($response->serverError())
        {
            return response()->json(['message' => 'Your request are currently unavailable'], 503);
        }
    }

    private function arrayResponse($response)
    {
        // do something
    }
}