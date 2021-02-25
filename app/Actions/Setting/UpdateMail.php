<?php

namespace App\Actions\Setting;

use Illuminate\Support\Facades\Validator;

class UpdateMail
{
    public function update(array $input)
    {
        Validator::make($input, [
            'email' => 'string|max:255|email|required',
            'name' => 'string|max:255|required'
        ])->validateWithBag('mail');

        $update = [];

        foreach ($input as $key => $value) {
            if ($value) {
                $update['mailfrom.' . $key] = $value;
            }
        }

        setting($update);
    }
}
