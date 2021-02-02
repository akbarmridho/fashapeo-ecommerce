<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('image')->store(config('image.upload_img_path'), 'public');

        return Storage::url($path);
    }
}
