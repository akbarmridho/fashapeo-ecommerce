<?php

namespace App\Transformers;

use Illuminate\Support\Str;

class FilepondImageSerializer
{
    public static function convert(array $images)
    {
        $result = [];

        foreach($images as $image)
        {
            if(! Str::endsWith(\strtolower($image), ['jpg', 'jpeg', 'png', 'webp'])) {
                $result['images'][] = ['content' => $image, 'is_new' => true];
            } else {
                $result['images'][] = ['content' => \basename($image), 'is_new' => false];
                $result['old'][] = $image;
            }
        }

        return $result;
    }
}