<?php

namespace App\Actions\Vendor;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exceptions\InvalidPathException;

class Filepond {

    public function getServerIdFromPath($path)
    {
        return Crypt::encryptString($path);
    }

    public function getPathFromServerId($serverId)
    {
        if (! trim($serverId)) {
            throw new InvalidPathException();
        }

        $filepath = Crypt::decryptString($serverId);
        if (! Str::startsWith($filepath, $this->getBasePath())) {
            throw new InvalidPathException();
        }

        return $filepath;
    }

    public function getBasePath()
    {
        return Storage::path(config('image.temp_img_path', 'temp_img'));
    }

    public function move($id, $path, $image)
    {
        $baseOldPath = $this->getPathFromServerId($id);
        $basePath = Storage::disk('public')->path($path);
        
        $oldPath = $baseOldPath . DIRECTORY_SEPARATOR . $images;
        $finalPath = $basePath . DIRECTORY_SEPARATOR . $images;
        Storage::move($oldPath, $finalPath);
    }

    public function deleteTemporaryPath($ids)
    {
        if(is_array($ids)) {
            foreach($ids as $id){
                Storage::deleteDirectory($this->getPathFromServerId($id));
            }
        } else {
            Storage::deleteDirectory($this->getPathFromServerId($ids));
        }
    }
}