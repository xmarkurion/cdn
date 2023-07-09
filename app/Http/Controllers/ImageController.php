<?php

namespace App\Http\Controllers;

// import the Intervention Image Manager Class
use App\Classes\Imaginator;
use App\Jobs\ThumbJob;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\FileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.create');
    }

    public function fullSizeImageDownload($id){
        $file = FileImage::findOrFail($id);
        return response()->download($file->getImagePath(), $file->original_name);
    }

    public function thumbImageDownload($id){
        $file = FileImage::findOrFail($id);
        return response()->download($file->getThumbPath(), $file->original_name);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $originalName = $request->image->getClientOriginalName();
        $new_image_name = uuid_create();
        $extension = $request->image->extension();

        Storage::putFileAs('uploadedImages/originals', $request->file('image'), $new_image_name.'.'.$extension);

        $newImage = new FileImage();
        $newImage->filename = $new_image_name;
        $newImage->original_name = $originalName;
        $newImage->extension = $extension;
        $newImage->file_size = (float) ($request->image->getSize());

        $newImage->folder= 'uploadedImages';

        $newImage->saved_file_name = $new_image_name.'.'.$extension;
        $newImage->save();

        ThumbJob::dispatch($newImage->id)->delay(1);

        return redirect()->route('home');
    }

    public function resize($id){

        $image = FileImage::findOrFail($id);
        Imaginator::resizeImageFile($image, 300, 300);
    }

    /**
     * Display the specified resource.
     */
    public function show(FileImage $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileImage $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FileImage $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileImage $image)
    {
        //
    }
}
