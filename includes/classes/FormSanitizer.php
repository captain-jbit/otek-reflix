<?php


class FormSanitizer{

    #make the first letter appear capital
    public static function sanitizeFormString($inputText){
        $inputText = strip_tags($inputText);#remove html tags
        $inputText = str_replace(" ", "", $inputText);#remove any spaces
        $inputText = strtolower($inputText);#to lower case
        $inputText = ucfirst($inputText);#make the first letter capital
        return $inputText;
    }

      
     public static function sanitizeFormUsername($inputText){
            $inputText = strip_tags($inputText);#remove html tags
            $inputText = str_replace(" ", "", $inputText);#remove any spaces
            return $inputText;
        }

    public static function sanitizeFormPassword($inputText){
            $inputText = strip_tags($inputText);#remove html tags

            return $inputText;
        }

        public static function sanitizeFormEmail($inputText){
            $inputText = strip_tags($inputText);#remove html tags
            $inputText = str_replace(" ", "", $inputText);#remove any spaces
            return $inputText;
        }
}



?>