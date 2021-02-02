<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Transformers\DateConverter;
use Illuminate\Support\Facades\Validator;

class UpdateDiscount
{
    public function update(Product $product, array $input)
    {
        Validator::make($input, $this->validationRules($input))->validate();

        return $product->discount()->updateOrCreate([
            'discount_value' => $input['discount_value'],
            'valid_until' => DateConverter::parseToUTC($input['valid_until']),
        ]);
    }

    private function validationRules(array $input)
    {
        return [
            'discount_value' => 'required|lte:'.(int) $input['price'],
            'valid_until' => 'nullable|date|after:now',
        ];
    }
}
