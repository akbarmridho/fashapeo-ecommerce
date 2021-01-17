<?php

namespace App\Actions\Address;

trait AddressValidationRules {

    public function addressValidation()
    {
        return [
            'label' => 'string|nullable|max:100',
            'name' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'vendor_id' => 'required|integer',
            'district' => 'required|string|max:75',
            'postal_code' => 'required|digits:5',
            'delivery_address' => 'required|string|max:200',
            'phone' => 'required|starts_with:628,08|digits_between:9,15',
        ];
    }

}