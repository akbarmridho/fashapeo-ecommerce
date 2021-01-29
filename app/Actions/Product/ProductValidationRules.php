<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Rules\NotParentCategory;
use App\Rules\VariantsIsValid;
use Illuminate\Validation\Rule;

trait ProductValidationRules {
    
    public function createProductValidation ()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // 'unique:master_products,name',
            ],
            'category' => [
                'required',
                'integer',
                new NotParentCategory,
            ],
            'description' => [
                'required',
                'string',
            ],
            'usedVariant' => [
                'string',
                'nullable',
                new VariantsIsValid,
            ],
            'weight' => [
                'required',
                'integer',
                'lte:100000',
            ],
            'dimensions.*' => 'nullable|integer|lte:300',
        ];
    }

    public function variantValidation()
    {
        return [
            'price' => 'required|integer|gt:100',
            'stock' => 'required|integer|gt:0',
            'active' => 'sometimes',
            'sku' => 'nullable|string|max:20',
        ];
    }

    public function updateProductValidation($master)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('master_products')->ignore($master->id)
            ],
            'category' => [
                'required',
                'integer',
                new NotParentCategory,
            ],
            'description' => [
                'required',
                'string',
            ],
            'new_variants' => [
                'array',
                'sometimes',
            ],
            'weight' => [
                'required',
                'integer',
                'lte:100000',
            ],
            'dimensions.*' => 'nullable|integer|lte:300',
        ];
    }
}