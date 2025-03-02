<?php
class Router
{
    private $routes = [];

    public function addRoute($route, $callback)
    {
        $this->routes[$route] = $callback;
    }


    public function handleRequest($uri)
    {
        $scriptName = dirname($_SERVER["SCRIPT_NAME"]);
        $requestUri = str_replace($scriptName, '', $uri);

        // Check for dynamic routes (e.g., "/orders/edit/5")
        foreach ($this->routes as $route => $callback) {
            $pattern = preg_replace('/\/:\w+/', '/(\d+)', $route); // Convert "/orders/edit/:id" -> "/orders/edit/(\d+)"
            if (preg_match("#^$pattern$#", $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                return call_user_func_array($callback, $matches); // Pass extracted ID
            }
        }

        // Regular exact match
        if (isset($this->routes[$requestUri])) {
            $this->routes[$requestUri]();
        } else {
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }


    // public function handleRequest($uri) {
    //     // Get the base folder dynamically

    //     $scriptName = dirname($_SERVER["SCRIPT_NAME"]); 
    //     $requestUri = str_replace($scriptName, '', $uri); 
    //     //  $requestUri /users /  /register
    //     // Debugging - Print the corrected request URI
    //     echo "Fixed Requested URI: " . $requestUri . "<br>";

    //     // Check if the route exists
    //     if (isset($this->routes[$requestUri])) {
    //         $this->routes[$requestUri]();
    //     } else {
    //         http_response_code(404);
    //         echo "404 - Page Not Found";
    //     }
    // }
}
