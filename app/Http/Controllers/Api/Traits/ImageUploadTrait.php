<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// trait ImageUploadTrait
// {
//     public function uploadImage($image)
//     {
//         $filename = time() . '_'. $image->getClientOriginalName();
//         $file_path = $image->storeAs('public/images', $filename);

//         $result['name'] = $filename;
//         $result['path'] = $file_path;
//         return $result;

//     }
//     public function deleteImage($image)
//     {
//         try {
//             if ($image) {
//                 Storage::delete($image);
//             }

//             return true;
//         } catch (\Throwable $th) {
//             report($th);

//             return $th->getMessage();
//         }
//     }

// }
trait ImageUploadTrait
{
    public function uploadImage($request, $input = "image", $folder_name)
    {
        try {
                if ($request->hasFile($input)) {
                $file = $request->file($input);
                $file_name =  time() . '_'. $file->getClientOriginalName();
                $path = "images/" . $folder_name;
                $file_full_name = $path . $file_name;
                $file->move($path, $file_name);
                // file_put_contents($file_full_name, $photo64);

                return $file_full_name;
                }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteImage($file_name)
    {

        if (File::exists($file_name)) {
            File::delete($file_name);
            return true;
        } else {
            return false;
        }
    }
}