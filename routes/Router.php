<?php
class Router {
    private $routes = [];

    public function addRoute($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function handleRequest($uri) {
        // Get the base folder dynamically
        
        $scriptName = dirname($_SERVER["SCRIPT_NAME"]); 
        $requestUri = str_replace($scriptName, '', $uri); 
        //  $requestUri /users /  /register
        // Debugging - Print the corrected request URI
        echo "Fixed Requested URI: " . $requestUri . "<br>";

        // Check if the route exists
        if (isset($this->routes[$requestUri])) {
            $this->routes[$requestUri]();
        } else {
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }
}
?>
