<?php

namespace App\Actions\Auth;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class CreateNewUser implements CreatesNewUsers
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'sex' => ['required'],
            'birthDate' => ['date'],
            'password' => $this->passwordRules(),
        ])->validate();

        return Customer::create([
            'name' => Str::title($input['name']),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'sex' => $input['sex'],
            'born_at' => Carbon::parse($input['birthDate'])->format('Y-m-d'),
        ]);
    }
}
