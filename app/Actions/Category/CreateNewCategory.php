<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateNewCategory
{
    public function create(array $input)
    {
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
            'name' => Str::title($input['name']),
            'description' => $input['description'],
            'slug' => Str::slug($input['name'], '-'),
            'parent_id' => $input['parent'],
        ]);

        return $category;
    }
}
