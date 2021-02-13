<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if (config('image.img_disk') !== 'local' || config('image.img_disk') !== 'public') {
            $path = $request->file('image')->store(config('image.upload_img_path'), config('image.img_disk'));
            return Storage::disk(config('image.img_disk'))->url($path);
        }

        $path = $request->file('image')->store(config('image.upload_img_path'), 'public');
        return Storage::url($path);
    }
}
