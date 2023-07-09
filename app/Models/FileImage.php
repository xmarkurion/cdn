<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileImage extends Model
{
    use HasFactory;

    /**
     * @return string Returns the image path from storage
     */
    public function getImagePath() : string
    {
        return storage_path('app/'
            .$this->folder
            .'/originals/'
            .$this->saved_file_name
        );
    }

    public function getThumbPath() : string
    {
        return storage_path('app/'
            .$this->folder
            .'/thumbs/'
            .$this->saved_file_name
        );
    }
}
