<?php

namespace App\Models;

use App\Models\User;

class Customer extends User
{
    use \Parental\HasParent; 
}
