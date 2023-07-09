<?php

namespace App\Jobs;

use App\Classes\Imaginator;
use App\Models\FileImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ThumbJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo 'Create thumb of image id: '.$this->id.PHP_EOL;
        $image = FileImage::findOrFail($this->id);
        Imaginator::resizeImageFile($image, 300, 300);
        echo 'Create thumb of image id: '.$this->id.' finished successfully'.PHP_EOL;
    }
}
