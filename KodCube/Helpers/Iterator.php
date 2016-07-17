<?php
namespace KodCube\Helpers;

class Iterator implements \Iterator,\Countable,\JsonSerializable
{
  protected $data = [];
  
  public function __get($key) 
  {
    if (isset($this->data[$key])) return $this->data[$key];
    return null;
  }
 
  public function __isset($key) 
  { 
    return isset($this->data[$key]);
  }
  
  public function rewind()  
  {
    reset($this->data);
  }
  
  public function current()
  {
    return current($this->data);
  }

  public function key()     
  {
    return key($this->data);
  }

  public function next()
  {
    return next($this->data);
  }
  
  public function valid()
  {
    return (key($this->data) !== NULL); 
  }
  
  public function count()
  {
    return sizeof($this->data);
  }
  
  public function jsonSerialize()
  { 
    return array_values($this->data);
  }
}