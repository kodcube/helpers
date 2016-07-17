<?php
namespace Exception\Helpers;


class Objects
{
  public static function merge($obj,$obj2)
  {
    if (is_object($obj)) {
      
      if (is_object($obj2) || is_array($obj2)) {
        
        foreach ($obj2 as $k => $v) {
          
          if (is_array($v)) {
            
            if (!isset($obj->$k)) $obj->$k = [];
            $obj->$k = static::merge($obj->$k, $v);
            
          } elseif (is_object($v)) {
            
            if (!isset($obj->$k)) $obj->$k = new \stdClass();
            
            $obj->$k = static::merge($obj->$k, $v);
            
          } elseif ( ! empty($v) ) $obj->$k = $v;
        }
      }
    } else if (is_array($obj)) {
      
      foreach ($obj2 as $k => $v) {

        if (is_array($v)) {
          
          if (!isset($obj[$k])) $obj[$k] = [];
          
          $obj[$k] = static::merge($obj[$k], $v);
          
        } elseif (is_object($v)) {
          
          if (!isset($json[$k])) $obj[$k] = new \stdClass();
          
          $obj[$k] = static::merge($obj[$k], $v);
          
        } elseif ( ! empty($v) ) $obj[$k] = $v;
      }
    }
    return $obj;
  }
  
}