<?php

namespace App\Actions;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CreateNewCategory {

    public function create(array $input) {

        Validator::make($input, [
             'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique(Category::class),
            ],
             'description' => ['string', 'max:255', 'nullable'],
             'parent' => 'integer|nullable',
        ])->validate();

        $category = Category::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'slug' => Str::slug($input['name'], '-'),
            'parent_id' => $input['parent'],
        ]);

        return $category;
    }

}