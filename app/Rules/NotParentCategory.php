<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class NotParentCategory implements Rule
{
    public function passes($attribute, $value)
    {
        $category = Category::find($value);

        if (! $category->children->first()) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Selected category should not be a parent category';
    }
}