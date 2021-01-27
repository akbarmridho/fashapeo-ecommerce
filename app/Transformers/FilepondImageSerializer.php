<?php

namespace App\Transformers;

class FilepondImageSerializer
{
    public static function convert(array $images)
    {
        $result = [];

        foreach($images as $image)
        {
            if(is_dir($image)) {
                $result['images'][] = ['content' => $image, 'is_new' => true];
            } else {
                // periksa input pada fetch method filepond
                // image haruslah berisi relative path url pada model image
                $result['images'][] = ['content' => \basename($image), 'is_new' => false];
                $result['old'][] = $image;
            }
        }

        return $result;
    }
}