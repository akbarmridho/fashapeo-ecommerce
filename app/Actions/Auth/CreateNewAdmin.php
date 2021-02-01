<?php

namespace App\Actions\Auth;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CreateNewAdmin implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'sex' => 'required',
            'phone' => 'nullable|starts_with:628,08|digits_between:9,15',
            'birthDate' => 'date',
        ])->validate();

        return Admin::create([
            'first_name' => Str::title($input['first_name']),
            'last_name' => Str::title($input['last_name']),
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
            'sex' => $input['sex'],
            'born_at' => Carbon::parse($input['birthDate'])->format('Y-m-d'),
        ]);
    }
}
