<?php

namespace App\Rules;

use App\Actions\Product\UsedVariant;
use App\Models\Variant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class VariantsIsValid implements Rule
{
    use UsedVariant;

    public function passes($attribute, $value)
    {
        $variants = $this->retreiveUsedVariant($value);

        if (! $variants) {
            return false;
        }

        foreach ($variants as $variant) {
            if ($var = Variant::find($variant['id'])) {
                if ($var->name !== Str::title($variant['name'])) {
                    return false;
                }
            } else {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Used variants name or id is invalid';
    }
}
