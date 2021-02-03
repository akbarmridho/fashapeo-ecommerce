<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\User;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'sex' => 'required',
            'phone' => 'nullable|starts_with:628,08|digits_between:9,15',
            'birtDate' => 'date'
        ])->validateWithBag('updateProfileInformation');

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => Str::title($input['first_name']),
                'last_name' => Str::title($input['last_name']),
                'email' => $input['email'],
                'phone' => $input['phone'],
                'sex' => $input['sex'],
                'born_at' => Carbon::parse($input['birthDate'])->format('Y-m-d'),
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'first_name' => Str::title($input['first_name']),
            'last_name' => Str::title($input['las_name']),
            'email' => $input['email'],
            'email_verified_at' => null,
            'phone' => $input['phone'],
            'sex' => $input['sex'],
            'born_at' => Carbon::parse($input['birthDate'])->format('Y-m-d'),
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
