<?php

namespace App\Actions\Vendor;

use App\Exceptions\InvalidPathException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Filepond
{
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

        if (! Str::startsWith($filepath, config('image.temp_img_path', 'temp_img'))) {
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

        $publicPrefix = 'public';
        $imageName = \basename($oldPath);

        if ($pathPrefix !== null) {
            $targetPath = $publicPrefix.DIRECTORY_SEPARATOR.$pathPrefix;
            $url = $pathPrefix.DIRECTORY_SEPARATOR.$imageName;
        } else {
            $targetPath = $publicPrefix;
            $url = $imageName;
        }

        $finalPath = $targetPath.DIRECTORY_SEPARATOR.$imageName;
        if (Storage::move($oldPath, $finalPath)) {
            $this->deleteTemporaryPath(\dirname($oldPath));

            return Storage::url($url);
        }
    }

    public function deleteFile($encryptedPath)
    {
        $path = $this->getPathFromServerId($encryptedPath);

        $res1 = Storage::delete($path);
        $res2 = $this->deleteTemporaryPath(\dirname($path));

        return $res1 && $res2;
    }

    public function deleteTemporaryPath($path)
    {
        return Storage::deleteDirectory($path);
    }
}
