<?php

namespace App\Core\Services\Infrastructure {
  
  interface IImageService
  {
    public function upload($image, $directory);
    public function uploadBase64($image, $directory);
    public function delete($path);
    public function resize($filename, $width, $height);
  }
}


