<?php

namespace App\Http\Controllers\Vendor;

use App\Repository\DeliveryRepositoryInterface;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    private $administration;

    public function construct(DeliveryRepositoryInterface $administration)
    {
        $this->administration = $administration;
    }

    public function provinces()
    {
        return $this->JSONResponse($this->administration->provinces());
    }

    public function cities($id = null)
    {
        return $this->JSONResponse($this->administration->cities($id));
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
}
