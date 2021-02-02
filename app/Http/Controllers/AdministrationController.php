<?php

namespace App\Http\Controllers;

use App\Repository\DeliveryRepositoryInterface;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    private $administration;

    public function __construct(DeliveryRepositoryInterface $administration)
    {
        $this->administration = $administration;
    }

    public function provinces()
    {
        return $this->JSONResponse($this->administration->provinces());
    }

    public function cities(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->id;
        } else {
            $id = null;
        }

        return $this->JSONResponse($this->administration->cities($id));
    }

    private function JSONResponse($result)
    {
        if ($result->isEmpty()) {
            return response()->json(['message' => 'Your request are currently unavailable'], 503);
        } else {
            return response()->json(['results' => array_values($result->all())], 200);
        }
    }
}
