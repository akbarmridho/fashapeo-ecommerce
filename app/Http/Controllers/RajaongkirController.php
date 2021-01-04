<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class RajaongkirController extends Controller
{
    private $apiKey;

    function __construct() {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function provinces () {
        $apiUrl = 'https://api.rajaongkir.com/starter/province';

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($apiUrl);

        if($response->successful()) {
            return response()->json($response->json()['rajaongkir']['results']);
        }

    }

    public function cities ($id) {
        $apiUrl = 'https://api.rajaongkir.com/starter/city';

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($apiUrl, [
            'province' => $id
        ]);
        
        if($response->successful()){
            return response()->json($response->json()['rajaongkir']['results']);
        }
    }
}
