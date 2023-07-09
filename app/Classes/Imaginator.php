<?php

namespace App\Classes;

use App\Models\FileImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class Imaginator
{

    public function __construct()
    {
        //
    }
    public static function resize(
        $image_input_file_path,
        $image_output_file_path,
        int $width,
        int $height){

        $image = Image::make($image_input_file_path)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_output_file_path);
    }

    public static function resizeImageFile(FileImage $image, int $width, int $height){
        $image_input_file_path = $image->getImagePath();
        $image_output_file_path = storage_path('app/'.$image->folder.'/thumbs/'.$image->saved_file_name);

        // If path does not exist, create it
        $thumb_path = storage_path('app/'.$image->folder.'/thumbs/');
        if(!File::exists($thumb_path)) {
            File::makeDirectory(storage_path('app/'.$image->folder.'/thumbs/'), $mode = 0777, true, true);
        }

        self::resize($image_input_file_path, $image_output_file_path, $width, $height);
    }

}
