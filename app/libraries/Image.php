<?php namespace App\Libraries\Image;

// We need to add these namespaces
// in order to have access to these classes.
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

/**
 * Class Image
 * @package App\Libraries\Image
 */
class Image {

    protected $imagine;

    /**
     * @param null $library
     */
    public function __construct($library = null) {
        if ( !$this->imagine) {
            if ( !isset($this->library) and class_exists('Imagick')) {
                $this->imagine = new \Imagine\Imagick\Imagine();
            } else {
                $this->imagine = new \Imagine\Gd\Imagine();
            }
        }
    }

    /**
     * @param string $filename
     * @param string $sizeString
     * @return mixed
     */
    public function resize($filename, $sizeString) {

        $outputDir = Config::get('assets.images.paths.output');
        $cleanFilename = $this->getCleanOutputFilename($filename);
        $outputFile = $outputDir . '/' . $sizeString . '_' . $cleanFilename;

        if (File::isFile($outputFile)) {
            return File::get($outputFile);
        }

        $inputDir = Config::get('assets.images.paths.input');
        $inputFile = $inputDir . '/' . $filename;

        $sizeArr = Config::get('assets.images.sizes.' . $sizeString);
        $width = $sizeArr['width'];
        $height = $sizeArr['height'];

        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

        if (!File::isDirectory($outputDir)) {
            File::makeDirectory($outputDir);
        }
        $this->imagine->open($inputFile)
            ->thumbnail($size, $mode)
            ->save($outputFile, array('quality' => 90));

        return File::get($outputFile);
    }

    /**
     * @param string $filename
     * @return string mimetype
     */
    public function getMimeType($filename) {
        $inputDir = Config::get('assets.images.paths.input');
        $inputFile = $inputDir . '/' .  $filename;
        $file = new \Symfony\Component\HttpFoundation\File\File($inputFile);
        return $file->getMimeType();
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    private function getCleanOutputFilename($filename) {
        $filename = (string)$filename;
        $cleanName = basename($filename);
        return $cleanName;
    }

}