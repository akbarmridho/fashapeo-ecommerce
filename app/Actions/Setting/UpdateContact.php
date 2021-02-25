<?php

namespace App\Actions\Setting;

use Illuminate\Support\Facades\Validator;

class UpdateContact
{
    public function update(array $input)
    {
        Validator::make($input, [
            'whatsapp' => 'nullable|starts_with:628|digits_between:9,15',
            'twitter' => 'string|nullable',
            'facebook' => 'string|nullable',
            'email' => 'string|max:255|email|nullable'
        ])->validateWithBag('contact');

        $update = [];

        foreach ($input as $key => $value) {
            if ($value) {
                $update['contact.' . $key] = $value;
            }
        }

        setting($update)->save();
    }
}
