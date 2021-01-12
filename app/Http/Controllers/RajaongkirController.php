<?php

namespace App\Http\Controllers;

use App\Actions\Vendor\Rajaongkir;
use Illuminate\Http\Request;

class RajaongkirController extends Controller
{
    private $rajaongkir;

    public function construct (Rajaongkir $rajaongkir)
    {
        $this->rajaongkir = $rajaongkir;
    }

    public function provinces () {
        
        if($result = $this->rajaongkir->fetchProvinces()) {
            return response()->json($result);
        }

    }

    public function cities ($id = null) {
        
        if($result = $this->rajaongkir->fetchProvinces()) {
            return response()->json($result);
        }
        
    }
}
