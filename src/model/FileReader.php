<?php
class FileReader{
    private $pathToImages = "public/images";
    
    public function getImages($amount){
        $images = array_diff(scandir($this->pathToImages), array('..', '.'));
        return array_slice($images, 0, $amount);
    }
}