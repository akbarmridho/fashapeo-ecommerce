<?php

namespace App\Repository;

interface OrderRepositoryInterface
{
    public function active();

    public function cancelled();

    public function completed();
}
