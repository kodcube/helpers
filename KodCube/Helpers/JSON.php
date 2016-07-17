<?php
namespace KodCube\Helpers;

use Exception;

class JSON extends Objects
{
  public static function encode($object,$options=0)
  {

    $json = json_encode($object,$options);
    switch (json_last_error()) 
    {
      case JSON_ERROR_NONE:           return $json;
      case JSON_ERROR_DEPTH:          throw new Exception('Maximum stack depth exceeded');       break;
      case JSON_ERROR_STATE_MISMATCH: throw new Exception('Underflow or the modes mismatch');    break;
      case JSON_ERROR_CTRL_CHAR:      throw new Exception('Unexpected control character found'); break;
      case JSON_ERROR_SYNTAX:         throw new Exception('Syntax error, malformed JSON');       break;
      case JSON_ERROR_UTF8:           throw new Exception('Malformed UTF-8 characters, possibly incorrectly encoded'); break;
      default:                        throw new Exception('Unknown error'); break;
    }
  }

  public static function decode($json,$assoc=false)
  {

    $obj = json_decode($json,$assoc);
    switch (json_last_error()) 
    {
      case JSON_ERROR_NONE:           return $obj;
      case JSON_ERROR_DEPTH:          throw new Exception('Maximum stack depth exceeded');       break;
      case JSON_ERROR_STATE_MISMATCH: throw new Exception('Underflow or the modes mismatch');    break;
      case JSON_ERROR_CTRL_CHAR:      throw new Exception('Unexpected control character found'); break;
      case JSON_ERROR_SYNTAX:         throw new Exception('Syntax error, malformed JSON');       break;
      case JSON_ERROR_UTF8:           throw new Exception('Malformed UTF-8 characters, possibly incorrectly encoded'); break;
      default:                        throw new Exception('Unknown error'); break;
    }
  }
}