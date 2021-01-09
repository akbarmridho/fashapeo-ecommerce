<?php

namespace App\Actions;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateCategory {

    public function update(array $input, Category $category) {

        Validator::make($input, [
             'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique(Category::class)->ignore($category->id),
            ],
             'description' => ['string', 'max:255', 'nullable'],
             'parent' => 'integer|nullable',
        ])->validate();

        $category->forceFill([
            'name' => Str::title($input['name']),
            'description' => $input['description'],
            'slug' => Str::slug($input['name'], '-'),
        ])->save();

        $hasChild = $category->children->isNotEmpty();

        if($input['parent'] !== null && ! $hasChild)
        {
            $category->parent_id = $input['parent'];
            $category->save();
        } 
        else if ($input['parent'] !== null && $hasChild)
        {
            return false;
        }
        else 
        {
            $category->parent_id = null;
            $category->save();
        }

    
        return $category;
    }
    
}