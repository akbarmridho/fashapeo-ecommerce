<?php

namespace App\Transformers;

class FilepondImageSerializer
{
    public static function convert(array $images)
    {
        $result = [];

        foreach($images as $image)
        {
            $data = \json_decode($image);
            $results['images'][] = $data;
            $results['ids'][] = $data['id'];
        }

        return $result;
    }
}