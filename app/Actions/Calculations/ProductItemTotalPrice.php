<?php

namespace App\Actions\Calculations;

trait ProductItemTotalPrice {

    public function calculate()
    {
        if($this->price_cut) {
            $price = $this->price - $this->price_cut;
        } else {
            $price = $this->price;
        }

        $this->final_price = ($price * $this->quantity);

        $this->save();
    }

}