<?php

namespace App\Models;

use App\Models\User;
use Parental\HasParent;

class Customer extends User
{
    use HasParent;

}
