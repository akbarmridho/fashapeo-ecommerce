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
        if (!trim($serverId)) {
            throw new InvalidPathException();
        }

        $filepath = Crypt::decryptString($serverId);

        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            if (!Str::startsWith($filepath, $this->getBasePath())) {
                throw new InvalidPathException();
            }
        } else {
            if (!Str::startsWith($filepath, config('image.temp_img_path', 'temp_img'))) {
                throw new InvalidPathException();
            }
        }

        return $filepath;
    }

    public function getBasePath()
    {
        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            return Storage::disk(config('image.img_disk'))->path(config('image.temp_img_path', 'temp_img'));
        } else {
            return Storage::path(config('image.temp_img_path', 'temp_img'));
        }
    }

    public function move($encryptedPath, $pathPrefix = null)
    {
        $oldPath = $this->getPathFromServerId($encryptedPath);

        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            return $this->moveCloudFile($oldPath, $pathPrefix);
        } else {
            return $this->moveLocalFile($oldPath, $pathPrefix);
        }
    }

    public function deleteFile($encryptedPath)
    {
        $path = $this->getPathFromServerId($encryptedPath);

        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            $res1 = Storage::disk(config('image.img_disk'))->delete($path);
        } else {
            $res1 = Storage::delete($path);
        }
        $res2 = $this->deleteTemporaryPath(\dirname($path));

        return $res1 && $res2;
    }

    public function deleteTemporaryPath($path)
    {
        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            return Storage::disk(config('image.img_disk'))->deleteDirectory($path);
        }

        return Storage::deleteDirectory($path);
    }

    private function moveLocalFile($oldPath, $pathPrefix = null)
    {
        $publicPrefix = 'public';
        $imageName = \basename($oldPath);

        if ($pathPrefix !== null) {
            $targetPath = $publicPrefix . DIRECTORY_SEPARATOR . $pathPrefix;
            $url = $pathPrefix . DIRECTORY_SEPARATOR . $imageName;
        } else {
            $targetPath = $publicPrefix;
            $url = $imageName;
        }

        $finalPath = $targetPath . DIRECTORY_SEPARATOR . $imageName;
        if (Storage::move($oldPath, $finalPath)) {
            $this->deleteTemporaryPath(\dirname($oldPath));

            return Storage::url($url);
        }
    }

    private function moveCloudFile($oldPath, $pathPrefix = null)
    {
        $imageName = basename($oldPath);

        if ($pathPrefix !== null) {
            $targetPath = $pathPrefix;
            $url = $pathPrefix . DIRECTORY_SEPARATOR . $imageName;
        } else {
            $targetPath = '';
            $url = $imageName;
        }

        $finalPath = $targetPath . DIRECTORY_SEPARATOR . $imageName;
        if (Storage::disk(config('image.img_disk'))->move($oldPath, $finalPath)) {
            return Storage::disk(config('image.img_disk'))->url($url);
        }
    }
}
