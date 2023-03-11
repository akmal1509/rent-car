<?php

namespace App\Traits;

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
            // $url = Storage::url($img);
        }

        return $input;
    }
}
