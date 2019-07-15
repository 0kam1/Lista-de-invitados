<?php

class TextToImage {
    private $img;
    
    /**
     * Create image from text
     * @param string text to convert into image
     * @param int font size of text
     * @param int width of the image
     * @param int height of the image
     */
    function createImage($text, $fontSize = 20, $imgWidth = 600, $imgHeight = 400){

        //text font path
        $font = 'c:/xampp/htdocs/lista/fonts/Roboto-Regular.ttf';

        //create the image
        $this->img = imagecreatetruecolor($imgWidth, $imgHeight);
        
        //create some colors
        $white = imagecolorallocate($this->img, 255, 255, 255);
        $grey = imagecolorallocate($this->img, 128, 128, 128);
        $black = imagecolorallocate($this->img, 0, 0, 0);
        imagefilledrectangle($this->img, 0, 0, $imgWidth, $imgHeight, $white);
        $angle = 0;

        //break lines
        $splitText = explode ( "\\n" , $text );
        $lines = count($splitText);
        
        foreach($splitText as $txt){
            $textBox = imagettfbbox($fontSize,$angle,$font,$txt);
            $textWidth = abs(max($textBox[2], $textBox[4]));
            $textHeight = abs(max($textBox[5], $textBox[7]));
            $x = (imagesx($this->img) - $textWidth)/2;
            $y = ((imagesy($this->img) + $textHeight)/2)-($lines-2)*$textHeight;
            $lines = $lines-1;
        
            //add the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $black, $font, $txt);
        }
        return true;
    }
    
   
    /**
     * Save image as jpg format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsJpg($fileName, $location){
        $fileName = $fileName.".jpg";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagejpeg($this->img, $fileName);
    }
}