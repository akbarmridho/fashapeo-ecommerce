<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

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
