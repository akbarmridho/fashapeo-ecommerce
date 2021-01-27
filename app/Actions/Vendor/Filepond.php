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

    public function move($encryptedPath, $pathPrefix = null)
    {
        $oldPath = $this->getPathFromServerId($encryptedPath);
        $targetPath = Storage::disk('public')->path($pathPrefix);
        $imageName = \basename($oldPath);

        $finalPath = $targetPath . DIRECTORY_SEPARATOR . $imageName;
        if(Storage::move($oldPath, $finalPath)) {
            $this->deleteTemporaryPath(\dirname($oldPath));
            return $finalPath;
        }
    }

    public function deleteTemporaryPath($path)
    {
        if(\is_dir($path)) {
            Storage::deleteDirectory($path);
        }
    }
}