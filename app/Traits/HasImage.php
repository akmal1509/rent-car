<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function uploadImage($request)
    {
        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image');
            $filenamewithextension  = $request->file('image')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input     = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destination = 'upload/images';
            $img = Storage::putFileAs($destination, $image, $input);
        }

        return $input;
    }

    public function duplicateImage($data)
    {
        $file = asset('/storage/upload/images/' . $data);
        $fileName = File::name($file);
        $fileExtention = File::extension($file);
        $first = substr($fileName, 0, strrpos($fileName, '-'));
        $input = $first . '-' . time() . '.' . $fileExtention;
        $image = Storage::copy('upload/images/' . $data, 'upload/images/' . $input);
        return $input;
    }

    public function deleteImage($data)
    {
        return Storage::move('upload/images/' . $data, 'tmp/' . $data);
    }

    public function restoreImage($data)
    {
        return Storage::move('tmp/' . $data, 'upload/images/' . $data);
    }

    public function forceImage($data)
    {
        return Storage::delete('upload/images/' . $data);
    }
}
