<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\MasterProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\VariantOption;
use App\Models\Variant;

class UpdateProduct {

    public function update ()
    {
        //sync images

        //sync variants. jika ada yang hilang, berarti harus dihapus. pakai collection filter

        //buat variants baru

        //update info biasa
    }
    
}