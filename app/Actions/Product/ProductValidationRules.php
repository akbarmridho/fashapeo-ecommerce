<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Rules\NotParentCategory;

trait ProductValidationRules {
    
    public function masterProductValidation ()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:master_products,name',
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
            ],
            'variants.*.price' => 'required|integer',
            'variants.*.stock' => [
                'required',
                'integer',
                'gt:0',
            ],
            'variants.*.active' => 'required|boolean',
            'variants.*.sku' => 'required|string|max:20',
            'weight' => [
                'required',
                'integer',
                'lte:100000',
            ],
            'dimensions.*' => 'required|integer|lte:300',
        ];
    }
}