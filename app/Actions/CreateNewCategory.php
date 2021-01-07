<?php

namespace App\Actions;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CreateNewCategory {

    use Subcategory;

    public function create(array $input) {

        Validator::make($input, [
             'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique(Category::class),
            ],
             'description' => ['string', 'max:255'],
             'parent_id' => 'integer',
        ])->validate();

        $category = Category::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'slug' => Str::slug($input['name'], '-'),
        ]);

        if($input['parent_id'] !== null)
        {
            $this->setParent($input['parent_id'], $category);
        }

        return $category;
    }

}