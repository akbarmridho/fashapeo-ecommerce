<?php

namespace App\Actions\Setting;

use Illuminate\Support\Facades\Validator;

class UpdateContact
{
    public function update(array $input)
    {
        Validator::make($input, [
            'whatsapp' => 'nullable|starts_with:628,08|digits_between:9,15',
            'twitter' => 'string|nullable',
            'facebook' => 'string|nullable',
            'email' => 'string|max:255|email|nullable'
        ])->validateWithBag('contact');

        setting([
            'contact.whatsapp' => $input['whatsapp'],
            'contact.twitter' => $input['twitter'],
            'contact.facebook' => $input['facebook'],
            'contact.email' => $input['email'],
        ]);
    }
}
