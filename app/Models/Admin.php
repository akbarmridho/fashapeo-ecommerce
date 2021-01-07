<?php

namespace App\Models;

use App\Models\User;
use Parental\HasParent;

class Admin extends User
{
    use HasParent;
  
}
