<?php
namespace KodCube\Helpers;


class Arrays 
{
  
  static function isAssoc(array $arr):bool
  {
    return array_keys($arr) !== range(0, count($arr) - 1);
  }
  
  static function toAssoc(array $inArray,string $separator = '_'):array 
  {
    $outArray = [];
    
    foreach ($inArray AS $name=>$value)
    {
      $keys = array_filter(explode($separator,$name));
      
      if (empty($keys)) continue;
      
      $array = &$outArray;
      while ($key = array_shift($keys)) {

        if (empty($key)) continue;

        if ( ! isset($array[$key]) ) {

          $array[$key]= [];

        } elseif (isset($array[$key]) && !is_array($array[$key])) {

          $array[$key] = ['value' => $array[$key]];

        }
        
        $array = &$array[$key];
      
      }
      
      $array = $value;
    }
    
    return $outArray;
  }
  
}