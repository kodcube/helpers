<?php
namespace KodCube\Helpers;

class Classes 
{
    public static function call($className,$methodParams=null,$classParams=null)
    {
        
        $className  = str_replace('.','\\',$className);
        $methodName = null;
        
        if (strpos($className,'::') !== false) {

            list($className,$methodName) = explode('::',$className);

        }
        
        // Check if the Class Exists
        
        if (!class_exists($className,true)) throw new \Exception($className.' does not exist');
        
        
        if ( ! is_null($methodName) ) {
            
            // Check if Static Method or Object Method Call

            $reflectionMethod = new \ReflectionMethod($className,$methodName); 
            if ($reflectionMethod->isStatic()) {
                
                return static::staticMethodCall($className,$methodName,$methodParams);
            }
            
            
            // Create Instance of Class
            
            return static::objectMethodCall($className,$classParams,$methodName,$methodParams);
        }

        // If there are no method must be a invokable object
      
        // Create Instance of Class
        $class = static::createObject($className,$classParams);

        if ( ! is_callable($class) ) {
            throw new \Exception($className.' is not callable');
        }
        
        return static::objectCall($class,$methodParams);
    }


    public static function staticMethodCall($className,$methodName,$methodParams=null) 
    {
       // Static Method Call
        if ( is_array($methodParams) && ! Arrays::isAssoc($methodParams) ) {

            // Invoke Static Method with multiple arguments
            return $className::$methodName(...$methodParams);

        }
        
        // Invoke Static Method with single argument 
        return $className::$methodName($methodParams);

    }
    
    public static function objectMethodCall($className,$classParams=null,$methodName,$methodParams=null)
    {
        $class = static::createObject($className,$classParams);
    
        if ( ! method_exists($class,$methodName) ) {
            throw new \Exception($className.'::'.$methodName.' not found');
        }
  
        if ( ! is_callable($className.'::'.$methodName) ) {

            throw new \Exception($className.'::'.$methodName.' is not Callable');

        }

        // Invoke Object Method with multiple arguments
        if ( is_array($methodParams) && ! Arrays::isAssoc($methodParams) ) {

            return $class->$methodName(...$methodParams);

        }

        // Invoke Object Method with single argument
        return $class->$methodName($methodParams);
    }
    
    public static function objectCall($class,$methodParams=null)
    {
        // Invoke Object Method with multiple arguments
        if ( is_array($methodParams) && ! Arrays::isAssoc($methodParams) ) {

            return $class(...$methodParams);

        }

        // Invoke Object Method with single argument
        return $class($methodParams);
    }

    public static function createObject($className,$classParams=null)
    {
        if ( is_array($classParams) && ! Arrays::isAssoc($classParams) ) {
            
            // Invoke Object with multiple arguments
            return new $className(...$classParams);

        }

        // Invoke Object with single argument
        return new $className($classParams);
    }
}