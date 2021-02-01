<?php

namespace App\Transformers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class FilepondImageSerializer
{
    public static function convert(array $images)
    {
        $result = [];

        foreach ($images as $image) {

            try {
                Crypt::decryptString($image);
                $result['images'][] = ['content' => $image, 'is_new' => true];
            } catch (DecryptException $exception) {
                $result['images'][] = ['content' => intval($image), 'is_new' => false];
                $result['old'][] = $image;
            }
        }

        return $result;
    }
}
