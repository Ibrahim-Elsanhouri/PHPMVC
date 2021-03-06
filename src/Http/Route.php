<?php

namespace Src\Http; 
use Src\Http\Request; 
use Src\Http\Response; 

class Route
{ 
    // it should be protected 
  

    public static array $routes = [];
    public Request $request; 
    public Response $response;

public function __construct(Request $request , Response $response){
    $this->request = $request; 
    $this->response = $response; 
}
    public static function get($route , $action){
        self::$routes['get'][$route] = $action; 
    
    }
    public static function post($route , $action){
        self::$routes['post'][$route] = $action; 
    
    }

    public function resolve()
    {
      $path = $this->request->path();
        $method = $this->request->method();

        $action = self::$routes[$method][$path] ?? false;


        //var_dump($path, $method , $action);

        if (!$action){
            return; 
        }
        if (is_callable($action)){
            call_user_func_array($action , []);
        }
        if (is_array($action)){
            call_user_func_array([new $action[0] , $action[1] , []]); 
        }

    }
}