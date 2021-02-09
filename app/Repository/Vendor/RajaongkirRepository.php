<?php

namespace App\Repository\Vendor;

use App\Repository\DeliveryRepositoryInterface;
use App\Transformers\RajaongkirTransformer as Transformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RajaongkirRepository implements DeliveryRepositoryInterface
{
    private $apiKey;
    private $http;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
        $this->http = Http::retry(3, 500)->withHeaders([
            'key' => $this->apiKey,
        ]);
    }

    public function provinces(): Collection
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/province';

        $response = $this->http->get($apiUrl);

        if ($result = $this->arrayResponse($response)) {
            return Transformer::transformProvinces($result);
        }

        return collect([]);
    }

    public function cities($provinceId = null): Collection
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        if ($provinceId) {
            $response = $this->http->get($apiUrl, ['province' => $provinceId]);
        } else {
            $response = $this->http->get($apiUrl);
        }

        if ($result = $this->arrayResponse($response)) {
            return Transformer::transformCities($result);
        }

        return collect([]);
    }

    public function cost(int $destination, int $origin, int $weight, string $courier): Collection
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/cost';

        $response = $this->http->post($apiUrl, [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        if ($result = $this->arrayResponse($response)) {
            return Transformer::transformCost($result);
        }

        return collect([]);
    }

    private function arrayResponse($response)
    {
        if ($response->successful()) {
            return $response['rajaongkir']['results'];
        }

        return false;
    }
}
