<?php

namespace App\Http\Controllers;

use App\Actions\Vendor\Filepond;
use App\Models\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if (empty($file)) {
            return Response::make('Image is required. Image must be sent on image field name', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        $path = config('image.temp_img_path', 'tmp_img');

        if (! $newFile = $file->store($path.DIRECTORY_SEPARATOR.Str::random())) {
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
        if ($this->filepond->deleteFile($request->getContent())) {
            return Response::make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make('Something went wrong', 500, [
            'Content-Type' => 'text/plain',
        ]);
    }

    public function load(Request $request)
    {
        if (! $request->has('load')) {
            return Response::make('Load parameter is required', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        if (! $request->has('type')) {
            return Response::make('Type parameter is required', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        try {
            $image = Image::findOrFail((int) $request->load);
        } catch (ModelNotFoundException $error) {
            return Response::make('Image not found in database', 404, [
                'Content-Type' => 'text/plain',
            ]);
        }

        switch ($request->type) {
            case 'product':
                $basePath = config('image.product_img_path');
                break;
            default:
                $basePath = null;
                break;
        }

        if (! $basePath) {
            return Response::make('Type parameter is invalid', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        $filename = basename($image->url);

        $path = Storage::disk('public')->path($basePath.DIRECTORY_SEPARATOR.$filename);

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        ]);
    }
}
