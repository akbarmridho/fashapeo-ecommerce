<?php

namespace App\Actions\Address;

use App\Modals\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateNewAddress {

    use AddressValidationRules;

    public function create(array $input, bool $active = false)
    {
        Validator::make($input, $this->addressValidation())->validate();

        return Address::create([
            'label' => $input['label'],
            'name' => $input['name'],
            'city' => $input['city'],
            'province' => $input['province'],
            'rajaongkir_id' => $input['rajaongkir_id'],
            'district' => $input['district'],
            'postal_code' => $input['postal_code'],
            'delivery_address' => $input['delivery_address'],
            'phone' => $input['phone'],
            'isMain' => $active,
        ]);
    }

}