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
                $result['images'][] = [''];
            }
        }
    }

    public static function oldConvert(array $images)
    {
        $result = [];

        foreach($images as $image)
        {
            if(! $data = \json_decode($image)) {
                $results['images'][] = array_merge($data, ['isNew' => false]);
                $results['ids'][] = $data['id'];
            } else {
                $results['images'][] = ['id' => (int) $image,
                                        'isNew' => false];
                $results['old'][] = (int) $image;
            }
        }

        return $result;
    }
}