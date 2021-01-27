<?php

namespace App\Services;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $path = implode('/', [
            sprintf('%02x', floor(($media->id - 1) / 256 / 256 / 256 / 256)),
            sprintf('%02x', floor(($media->id - 1) / 256 / 256 / 256)),
            sprintf('%02x', floor(($media->id - 1) / 256 / 256)),
            sprintf('%02x', floor(($media->id - 1) / 256)),
            $media->id . '.' . substr(md5($media->id . config('app.key')), 0, 16),
        ]);
        
        return $path . '/';
    }
    
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'c/';
    }
    
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'r/';
    }
}