<?php

namespace App\Models;

use App\Models\User;

class Admin extends User
{
    use \Parental\HasParent; 
}
