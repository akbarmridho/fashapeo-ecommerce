<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(Customer $user, Address $address)
    {
        return $user->id === $address->addressable->id;
    }
}
