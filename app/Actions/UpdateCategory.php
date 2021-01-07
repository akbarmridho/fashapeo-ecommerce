<?php

namespace App\Actions;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateCategory {

    use Subcategory;

    public function update(array $input, Category $category) {

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

        $category->forceFill([
            'name' => $input['name'],
            'description' => $input['description'],
            'slug' => Str::slug($input['name'], '-'),
        ])->save();

        if($input['parent_id'] !== null)
        {
            $this->setParent($input['parent_id'], $category);
        } else
        {
            $this->unsetParent($input['parent_id'], $category);
        }

        return $category;
    }
    
}