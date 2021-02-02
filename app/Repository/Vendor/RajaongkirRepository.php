<?php

namespace App\Repository\Vendor;

use Illuminate\Support\Facades\Http;
use App\Repository\DeliveryRepositoryInterface;
use App\Transformers\RajaongkirTransformer as Transformer;
use Illuminate\Support\Collection;

class RajaongkirRepository implements DeliveryRepositoryInterface
{
    private $apiKey;
    private $http;

    function __construct()
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

    public function address(int $cityId): array
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        $data = $this->http->get($apiUrl, ['id' => $cityId]);

        if (!$data->successful()) {
            return false;
        }

        return [
            'city' => $data['type'] . ' ' . $data['city_name'],
            'province' => $data['province'],
            'vendor_id' => $data['city_id'],
        ];
    }

    private function arrayResponse($response)
    {
        if ($response->successful()) {
            return $response['rajaongkir']['results'];
        }

        return false;
    }
}
