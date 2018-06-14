<?php

namespace IDist\ImageChecker;
class Image implements ImageInterface
{


    private $path;
    private $file;
    private $filename;
    private $version;

    function __construct($path = "")
    {
        $this->path = $path;
        if ($path != "") {
            $this->download();
        }
    }

    public function download($url = "")
    {
        $tmp_url = "";
        try {
            if ($url != "") {
                $sourse = file_get_contents($url);
                $tmp_url = $url;
                $this->path = $url;
            } elseif ($this->path != "") {
                $sourse = file_get_contents($this->path);
                $tmp_url = $this->path;
            } else {
                throw new \Exception("Url not found!");
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $storage = __DIR__ . "/../public/images/";
        $this->filename = $storage . md5($sourse) . "." . pathinfo($tmp_url, PATHINFO_EXTENSION);
        try {
            file_put_contents($this->filename, $sourse);
            $this->getVersion();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getType()
    {
        echo $this->version."\n";


        if ($this->isGIF()) {
            return "GIF";
        } elseif ($this->isJPG()) {
            return "JPG";
        } elseif ($this->isPNG()) {
            return "PNG";
        } elseif ($this->isBMP()) {
            return "BMP";
        } elseif ($this->isTIFF()) {
            return "TIFF";
        } else {
            return "Other";
        }
    }

    private function getVersion()
    {
        /* Open the image file in binary mode */
        if (!$fp = fopen($this->filename, 'rb')) return 0;

        /* Read 20 bytes from the top of the file */
        if (!$data = fread($fp, 20)) return 0;

        /* Create a format specifier */
        $header_format = 'A6version';  # Get the first 6 bytes

        /* Unpack the header data */
        $header = unpack($header_format, $data);

        $this->version = bin2hex($header['version']);
    }

    public function isGIF()
    {
        return !(mb_strpos($this->version, '474946') === false);
    }

    public function isJPG()
    {
        return !(mb_strpos($this->version, 'ffd8') === false);
    }

    public function isBMP()
    {
        return !(mb_strpos($this->version, '424d') === false);
    }

    public function isPNG()
    {
        return !(mb_strpos($this->version, '504e47') === false);
    }

    public function isTIFF()
    {
        return !(mb_strpos($this->version, '49492a00c846') === FALSE || mb_strpos($this->version,"4d4d002a") === FALSE);

    }
}