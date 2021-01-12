<?php

namespace App\Actions\Vendor;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Str;
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
        if (! Str::startsWith($filepath, $this->getBasePath)) {
            throw new InvalidPathException();
        }

        return $filepath;
    }

    public function getBasePath()
    {
        return Storage::path(config('images.temp_img_path', 'img_temp'));
    }
}