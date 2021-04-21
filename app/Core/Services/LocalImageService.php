<?php

namespace App\Core\Services {

    use App\Core\Services\Infrastructure\IImageService;
    use App\Core\Utility\StringUtility;
    use Illuminate\Support\Facades\Storage;

    class Image
    {
        private $file;
        private $image;
        private $width;
        private $height;
        private $bits;
        private $mime;

        public function __construct($file)
        {
            if (file_exists($file)) {
                $this->file = $file;

                $info = getimagesize($file);

                $this->width = $info[0];
                $this->height = $info[1];
                $this->bits = isset($info['bits']) ? $info['bits'] : '';
                $this->mime = isset($info['mime']) ? $info['mime'] : '';

                if ($this->mime == 'image/gif') {
                    $this->image = imagecreatefromgif($file);
                } elseif ($this->mime == 'image/png') {
                    $this->image = imagecreatefrompng($file);
                } elseif ($this->mime == 'image/jpeg') {
                    $this->image = imagecreatefromjpeg($file);
                }
            } else {
                exit('Error: Could not load image ' . $file . '!');
            }
        }

        public function getFile()
        {
            return $this->file;
        }

        public function getImage()
        {
            return $this->image;
        }

        public function getWidth()
        {
            return $this->width;
        }

        public function getHeight()
        {
            return $this->height;
        }

        public function getBits()
        {
            return $this->bits;
        }

        public function getMime()
        {
            return $this->mime;
        }

        public function save($file, $quality = 90)
        {
            $info = pathinfo($file);

            $extension = strtolower($info['extension']);

            if (is_resource($this->image)) {
                if ($extension == 'jpeg' || $extension == 'jpg') {
                    imagejpeg($this->image, $file, $quality);
                } elseif ($extension == 'png') {
                    imagepng($this->image, $file);
                } elseif ($extension == 'gif') {
                    imagegif($this->image, $file);
                }

                imagedestroy($this->image);
            }
        }

        public function resize($width = 0, $height = 0, $default = '')
        {
            if (!$this->width || !$this->height) {
                return;
            }

            $scale_w = $width / $this->width;
            $scale_h = $height / $this->height;

            if ($default == 'w') {
                $scale = $scale_w;
            } elseif ($default == 'h') {
                $scale = $scale_h;
            } else {
                $scale = min($scale_w, $scale_h);
            }

            if ($scale == 1 && $scale_h == $scale_w && $this->mime != 'image/png') {
                return;
            }

            $new_width = (int)($this->width * $scale);
            $new_height = (int)($this->height * $scale);
            $xpos = (int)(($width - $new_width) / 2);
            $ypos = (int)(($height - $new_height) / 2);

            $imageOld = $this->image;

            $this->image = imagecreatetruecolor($width, $height);

            if ($this->mime == 'image/png') {
                imagealphablending($this->image, false);
                imagesavealpha($this->image, true);
                $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
                imagecolortransparent($this->image, $background);
            } else {
                $background = imagecolorallocate($this->image, 255, 255, 255);
            }

            imagefilledrectangle($this->image, 0, 0, $width, $height, $background);

            imagecopyresampled(
                $this->image,
                $imageOld,
                $xpos,
                $ypos,
                0,
                0,
                $new_width,
                $new_height,
                $this->width,
                $this->height
            );
            imagedestroy($imageOld);

            $this->width = $width;
            $this->height = $height;
        }

        public function watermark(Image $watermark, $position = 'bottomright')
        {
            $watermark_pos_x = 0;
            $watermark_pos_y = 0;

            switch ($position) {
                case 'topleft':
                    $watermark_pos_x = 0;
                    $watermark_pos_y = 0;
                    break;
                case 'topcenter':
                    $watermark_pos_x = intval(($this->width - $watermark->getWidth()) / 2);
                    $watermark_pos_y = 0;
                    break;
                case 'topright':
                    $watermark_pos_x = $this->width - $watermark->getWidth();
                    $watermark_pos_y = 0;
                    break;
                case 'middleleft':
                    $watermark_pos_x = 0;
                    $watermark_pos_y = intval(($this->height - $watermark->getHeight()) / 2);
                    break;
                case 'middlecenter':
                    $watermark_pos_x = intval(($this->width - $watermark->getWidth()) / 2);
                    $watermark_pos_y = intval(($this->height - $watermark->getHeight()) / 2);
                    break;
                case 'middleright':
                    $watermark_pos_x = $this->width - $watermark->getWidth();
                    $watermark_pos_y = intval(($this->height - $watermark->getHeight()) / 2);
                    break;
                case 'bottomleft':
                    $watermark_pos_x = 0;
                    $watermark_pos_y = $this->height - $watermark->getHeight();
                    break;
                case 'bottomcenter':
                    $watermark_pos_x = intval(($this->width - $watermark->getWidth()) / 2);
                    $watermark_pos_y = $this->height - $watermark->getHeight();
                    break;
                case 'bottomright':
                    $watermark_pos_x = $this->width - $watermark->getWidth();
                    $watermark_pos_y = $this->height - $watermark->getHeight();
                    break;
            }

            imagealphablending($this->image, true);
            imagesavealpha($this->image, true);
            imagecopy(
                $this->image,
                $watermark->getImage(),
                $watermark_pos_x,
                $watermark_pos_y,
                0,
                0,
                $watermark->getWidth(),
                $watermark->getHeight()
            );

            imagedestroy($watermark->getImage());
        }

        public function crop($top_x, $top_y, $bottom_x, $bottom_y)
        {
            $imageOld = $this->image;
            $this->image = imagecreatetruecolor($bottom_x - $top_x, $bottom_y - $top_y);

            imagecopy($this->image, $imageOld, 0, 0, $top_x, $top_y, $this->width, $this->height);
            imagedestroy($imageOld);

            $this->width = $bottom_x - $top_x;
            $this->height = $bottom_y - $top_y;
        }

        public function rotate($degree, $color = 'FFFFFF')
        {
            $rgb = $this->html2rgb($color);

            $this->image = imagerotate(
                $this->image,
                $degree,
                imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2])
            );

            $this->width = imagesx($this->image);
            $this->height = imagesy($this->image);
        }

        private function html2rgb($color)
        {
            if ($color[0] == '#') {
                $color = substr($color, 1);
            }

            if (strlen($color) == 6) {
                list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            } else {
                return false;
            }

            $r = hexdec($r);
            $g = hexdec($g);
            $b = hexdec($b);

            return array($r, $g, $b);
        }
    }

    class LocalImageService implements IImageService
    {
        private $_rootImagesDir;


        public function __construct(string $rootImagesDir)
        {
            $this->_rootImagesDir = $rootImagesDir;
        }


        public function upload($image, $directory)
        {
            $target_dir = $this->_rootImagesDir . $directory;

            if (!is_dir($target_dir)) {
                @mkdir($target_dir, 0777, true);
            }

            $imagePathName = $image->getPathName();
            $imageFileType = mime_content_type($imagePathName);

            $filename = $this->generateRandomImageName($imageFileType);

            $target_file = $target_dir . '/' . $filename;
            $check = getimagesize($imagePathName);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                $uploadOk = 1;
            }

            if ($image->getSize() > 2000000) {
                $uploadOk = 0;
            }

            if ($imageFileType != "image/jpeg" && $imageFileType != "image/png" && $imageFileType != "image/gif" && $imageFileType != "image/webp" && $imageFileType != "image/svg+xml") {
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return null;
            } else {
                if (move_uploaded_file($imagePathName, $target_file)) {
                    return $directory . '/' . $filename;
                } else {
                    return null;
                }
            }
        }


        public function resize($filename, $width, $height)
        {
            if (!is_file($this->_rootImagesDir . $filename)) {
                return null;
            }

            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $image_old = $filename;
            $image_new = 'cache/' . $this->utf8_substr(
                    $filename,
                    0,
                    $this->utf8_strrpos($filename, '.')
                ) . '-' . $width . 'x' . $height . '.' . $extension;

            if (!is_file($this->_rootImagesDir . $image_new) || (filectime($this->_rootImagesDir . $image_old) > filectime(
                        $this->_rootImagesDir . $image_new
                    ))
            ) {
                list($width_orig, $height_orig, $image_type) = getimagesize($this->_rootImagesDir . $image_old);

                if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) {
                    return $this->_rootImagesDir . $image_old;
                }

                $path = '';

                $directories = explode('/', dirname($image_new));

                foreach ($directories as $directory) {
                    $path = $path . '/' . $directory;

                    if (!is_dir($this->_rootImagesDir . $path)) {
                        @mkdir($this->_rootImagesDir . $path, 0777);
                    }
                }

                if ($width_orig != $width || $height_orig != $height) {
                    $image = new Image($this->_rootImagesDir . $image_old);
                    $image->resize($width, $height);
                    $image->save($this->_rootImagesDir . $image_new);
                } else {
                    copy($this->_rootImagesDir . $image_old, $this->_rootImagesDir . $image_new);
                }
            }

            return '/images/' . $image_new;
        }

        public function delete($path)
        {
            try {
                unlink($this->_rootImagesDir . $path);
            } catch (\Exception $ex) {
            }
        }

        private function utf8_substr($string, $offset, $length = null)
        {
            if ($length === null) {
                return mb_substr($string, $offset, utf8_strlen($string));
            } else {
                return mb_substr($string, $offset, $length);
            }
        }

        private function utf8_strrpos($string, $needle, $offset = 0)
        {
            return mb_strrpos($string, $needle, $offset);
        }

        private function generateRandomImageName($type)
        {
            return StringUtility::generateRandomString() . $this->getFileExtensionByType($type);
        }

        private function getFileExtensionByType($type)
        {
            switch ($type) {
                case "image/jpg":
                    return ".jpg";
                    break;
                case "image/jpeg":
                    return ".jpeg";
                    break;
                case "image/svg+xml":
                    return ".svg";
                    break;
                case "image/png":
                    return ".png";
                    break;
                case "image/gif":
                    return ".gif";
                    break;
                default:
                    return ".ext";
            }
        }

        public function uploadBase64($files, $directory)
        {
            if (!empty($files)) {
                $files = array($files);
            }
            $links = [];
            if (count($files) > 0) {
                $target_dir = $this->_rootImagesDir . $directory;
                if (!is_dir($target_dir)) {
                    @mkdir($target_dir, 0777, true);
                }
                foreach ($files as $file) {
                    $data = explode(',', $file);

                    $imageFileType = explode(';', explode(':', $data[0])[1])[0];
                    $filename = $this->generateRandomImageName($imageFileType);
                    $target_file = $target_dir . '/' . $filename;
                    file_put_contents($target_file, base64_decode($data[1]));

                    $links[] = $directory . '/' . $filename;
                }
            }

            return $links;
        }

    }
}