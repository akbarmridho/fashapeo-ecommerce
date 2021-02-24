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

        setting([
            'mailfrom.address' => $input['email'],
            'mailfrom.name' => $input['name'],
        ]);
    }
}
