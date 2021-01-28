<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Actions\Vendor\Filepond;
use App\Http\Controllers\Controller;

class FilepondController extends Controller
{
    public $filepond;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;
    }

    public function upload(Request $request)
    {
        $file = $request->file('image');

        if(empty($file)) {
            return Response::make('Image is required. Image must be sent on image field name', 422, [
                'Content-Type' => 'text/plain'
            ]);
        }

        $path = config('image.temp_img_path', 'tmp_img');
        
        if (! $newFile =  $file->store($path . DIRECTORY_SEPARATOR . Str::random())) {
            return Response::make('Could not save file', 500, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make($this->filepond->getServerIdFromPath($newFile), 200, [
            'Content-Type' => 'text/plain',
        ]);

    }

    public function delete(Request $request)
    {

        if($this->filepond->deleteFile($request->getContent())) {
            return Response::make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make('Something went wrong', 500, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
