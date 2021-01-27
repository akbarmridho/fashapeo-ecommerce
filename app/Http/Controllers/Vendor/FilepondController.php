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
        foreach(array_keys($request->all()) as $req)
        {
            if($request->hasFile($req)) {

                $input = $request->file($req);
                break;

            }
        }

        if($input === null) {
            return Response::make('image is required', 422, [
                'Content-Type' => 'text/plain'
            ]);
        }

        $file = is_array($input) ? $input[0] : $input;
        $path = config('image.temp_img_path', 'tmp_img');
        
        if (! $newFile =  $file->storeAs($path . DIRECTORY_SEPARATOR . Str::random(), $file->getClientOriginalName())) {
            return Response::make('Could not save file', 500, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make($this->filepond->getServerIdFromPath(Storage::path($newFile)), 200, [
            'Content-Type' => 'text/plain',
        ]);

    }

    public function delete(Request $request)
    {
        $filePath = $this->filepond->getPathFromServerId($request->getContent());
        if(Storage::delete($filePath)) {
            return Response::make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make('File not found', 500, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
