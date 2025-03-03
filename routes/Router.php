<?php
class Router
{
    private $routes = [];

    public function addRoute($route, $callback)
    {
        $this->routes[$route] = $callback;
    }
    public function handleRequest($uri) {
        $scriptName = dirname($_SERVER["SCRIPT_NAME"]);
        $requestUri = str_replace($scriptName, '', $uri);
    
        echo "Requested URI: " . $uri . "<br>";
        echo "Script Name: " . $_SERVER["SCRIPT_NAME"] . "<br>";
        echo "Request URI after script name removal: " . $requestUri . "<br>";
        echo "Routes: " . print_r($this->routes, true) . "<br>";
    
        foreach ($this->routes as $route => $callback) {
            $pattern = preg_replace('/\/:(\w+)/', '/([^/]+)', $route);
if (preg_match("#^$pattern$#", $requestUri, $matches)) {
    array_shift($matches);
    return call_user_func_array($callback, $matches);
}
        }
    
        if (isset($this->routes[$requestUri])) {
            $this->routes[$requestUri]();
        } else {
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }

    // public function handleRequest($uri) {
    //     $scriptName = dirname($_SERVER["SCRIPT_NAME"]); 
    //     $requestUri = str_replace($scriptName, '', $uri); 

    //     // Debugging - Print the corrected request URI
    //     echo "Fixed Requested URI: " . $requestUri . "<br>";

    //     parse_str($_SERVER['QUERY_STRING'], $queryParams);

    //     if (isset($this->routes[$requestUri])) {
    //         $this->routes[$requestUri]($queryParams);
    //     } else {
    //         http_response_code(404);
    //         echo "404 - Page Not Found";
    //     }
    // }
}
