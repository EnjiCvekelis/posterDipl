<?php

namespace App\Core\Utility {
  
  class StringUtility
  {
    public static function startsWith($haystack, $needle, $case = true)
    {
      if ($case) {
        return strpos($haystack, $needle, 0) === 0;
      }
      
      return stripos($haystack, $needle, 0) === 0;
    }
    
    public static function endsWith($haystack, $needle, $case = true)
    {
      $expectedPosition = strlen($haystack) - strlen($needle);
      
      if ($case) {
        return strrpos($haystack, $needle, 0) === $expectedPosition;
      }
      
      return strripos($haystack, $needle, 0) === $expectedPosition;
    }
    
    public static function replaceSpecSymbols($text, $symbols = "_")
    {
      return preg_replace("/[\!\"\#\$\%\&\\\(\)\*\+\,\.\/\:\;\<\=\>\?\@\[\]\^\_\`\{\|\}\~\ ]/", $symbols, $text);
    }
    
    public static function generateRandomString($length = 10)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      
      return $randomString;
    }
    
    /**
     * Returns part of string after specified sub-string
     * @param $string
     * @param $substring
     * @return bool|string
     *
     * example:
     *
     * $myvar = 'Anti,Christ,World';
     * $myvar = strafter($myvar,',');  //$myvar = 'Christ,World'
     *
     */
    public static function strAfter($string, $substring) {
      $pos = strpos($string, $substring);
      if ($pos === false)
        return $string;
      else
        return(substr($string, $pos+strlen($substring)));
    }
    
    /**
     * Returns part of string before specified sub-string
     * @param $string
     * @param $substring
     * @return bool|string
     *
     * example:
     *
     * $myvar = 'Anti,Christ,World';
     * $myvar = strafter($myvar,',');  //$myvar = 'Christ,World'
     * echo $myvar; //result 'Christ,World'
     * echo strbefore($myvar,','); //result 'Christ'
     *
     */
    public static function strBefore($string, $substring) {
      $pos = strpos($string, $substring);
      if ($pos === false)
        return $string;
      else
        return(substr($string, 0, $pos));
    }
  
    public static function prepareLike($s, $e = '\\') {
      return "%".str_replace(array($e, '_', '%'), array($e.$e, $e.'_', $e.'%'), $s)."%";
    }
  }
}