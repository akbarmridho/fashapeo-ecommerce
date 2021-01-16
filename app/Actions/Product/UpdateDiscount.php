<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class UpdateDiscount
{
    public function update(Product $product, array $input)
    {
        Validator::make($input, $this->validationRules($input))->validate();

        return $product->discount()->updateOrCreate([
            'discount_value',
            'valid_until',
        ]);
    }

    private function validationRules(array $input)
    {
        return [
            'discount_value' => 'required|lte:' . (int) $input['price'],
            'valid_until' => 'nullable|date|after:now',
        ];
    }
}