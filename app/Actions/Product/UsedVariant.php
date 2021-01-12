<?php

namespace App\Actions\Product;

trait UsedVariant {

    public function retreiveUsedVariant($input)
    {
        if($input === null) {
            return false;
        }

        $variants = \explode(',', $input);

        $result = [];

        foreach($variants as $variant) {
            $variantData = \explode(':', $variant);
            array_push($result, ['name' => $variantData[0], 'id' => $variantData[1] ]);
        }

        return $result;
    }

}