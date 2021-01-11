<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class NotParentCategory implements Rule
{

    public function passes($attribute, Category $category)
    {
        if ($category->children->isEmpty()) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'The category should not be a parent category';
    }
}