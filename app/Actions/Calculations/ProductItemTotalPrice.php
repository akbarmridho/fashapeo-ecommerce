<?php

namespace App\Actions\Calculations;

class ProductItemTotalPrice
{
    public static function calculate($productInitial, $productDiscount, $quantity)
    {
        if ($productDiscount > 0) {
            return ($productInitial - $productDiscount) * $quantity;
        }

        return $productInitial * $quantity;
    }
}
