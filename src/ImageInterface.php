<?php
/**
 * Created by PhpStorm.
 * User: idist
 * Date: 12/06/2018
 * Time: 08:39
 */

namespace IDist\ImageChecker;

interface ImageInterface
{
    public function getType();
    public function isGIF();
    public function isJPG();
    public function isBMP();
    public function isPNG();
    public function isTIFF();
}