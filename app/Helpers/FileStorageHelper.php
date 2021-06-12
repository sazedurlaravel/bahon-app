<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Throwable;

class FileStorageHelper
{    
    /**
     * upload
     *
     * @param  mixed $file
     * @param  mixed $path
     * @param  mixed $oldFilePath
     * @param  mixed $width (For Image only)
     * @param  mixed $height (For Image only)
     * @return void
     */
    public function upload($file, string $path = '', string $oldFilePath = null, int $width = null, int $height = null)
    {
        // file not exist
        try {
            if(! $file->isValid()) {
                return false;
            }
        } catch(Throwable $e) {
            return false;
        }

        // delete old picture if exist
        $oldFilePath && Storage::delete($oldFilePath);

        // get file extension
        $extension = $file->extension();
        
        // set right extension
        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            $extension = 'webp';
        }

        // set file name and upload
        $fileName     = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '_')  . '.' . $extension;
        $uploadedPath = $file->storeAs($path, $fileName);

        // encode & resize if file is an image
        $extension == 'webp' && Image::make(Storage::path($uploadedPath))->encode('webp')->resize($width, $height)->save();

        return $uploadedPath;
    }
}