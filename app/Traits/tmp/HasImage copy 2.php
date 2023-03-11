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

        // if ($request->file('image')) {
        //     $image = $request->file('image');
        //     $image->storeAs('public/categories/', $image->hashName());
        // }

        if ($request->file('image')) {
            $image = $request->file('image');
            $filenamewithextension  = $request->file('image')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input     = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath        = public_path('img/upload/thumbs');
            // $thumb->save($destinationPath . '/' . $input);
            // $destinationPath = public_path('img/assets/upload');
            // $image->move($destinationPath, $input);

            $img = $image->storeAs('upload/images' . '/', $input);
            // $img = Storage::putFileAs('upload/images' . '/', $image, $input);
            // $thumb = Image::make($image->getRealPath())->fit(150);
            // if (!file_exists(storage_path($destinationPath))) {
            //     mkdir(storage_path($destinationPath), 666, true);
            // }

            $thumb = Image::make($request->file('image')->path())->encode('jpg', 90);
            // $thumb = Image::make($image)->fit(150)->encode();
            // $thumb->save(storage_path('public/upload/images/thumbs/' . $input));
            // $thumb->storeAs('upload/images/thumb', $input);
            Storage::putFileAs('upload/images/thumbs/', (string) $thumb, $input);
            // $thumb->store('upload/images/thumbs');

            // $thumb->save(storage_path($destinationPath) . '/' . $input);
            // $destinationPath = '/upload/images/';
            // $image->move(storage_path($destinationPath), $input);

            // if ($request->file('image')) {
            //     $image = $request->file('image');
            //     $filenamewithextension  = $request->file('image')->getClientOriginalName();
            //     $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //     $input['nama_file']     = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            //     $destinationPath        = './assets/upload/image/thumbs/';
            //     $img = Image::make($image->getRealPath(), array(
            //         'width'     => 150,
            //         'height'    => 150,
            //         'grayscale' => false
            //     ));
            //     $img->save($destinationPath . '/' . $input['nama_file']);
            //     $destinationPath = './assets/upload/image/';
            //     $image->move($destinationPath, $input['nama_file']);
        }

        return $input;
        // return $input['name_file'];
        // return $image;
    }
}
