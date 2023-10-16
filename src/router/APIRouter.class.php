<?php
include_once(PROJECT_ROOT_PATH . "/src/controllers/BaseController.class.php");
class APIRouter 
{
    private array $routes;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private const METHOD_PUT = 'PUT';
    private const METHOD_DELETE = "DELETE";

    public function get(string $path, $handler, $middlewares=[]) 
    {
        $this->addHandler(self::METHOD_GET, $path, $handler, $middlewares);
    }

    public function delete(string $path, $handler, $middlewares=[]) 
    {
        $this->addHandler(self::METHOD_DELETE, $path, $handler, $middlewares);
    }

    public function put(string $path, $handler, $middlewares=[]) 
    {
        $this->addHandler(self::METHOD_PUT, $path, $handler, $middlewares);
    }

    public function post(string $path, $handler, $middlewares=[]) 
    {
        $this->addHandler(self::METHOD_POST, $path, $handler, $middlewares);
    }
    private function addHandler(string $method, string $path, $handler, $middlewares=[]) 
    {
        $this->routes[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'middlewares' => $middlewares
        ];
    }

    public function run() 
    {
        $request_url = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_url['path'];
        $request_method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $middlewares = array();
        $path_params = array();
        foreach ($this->routes as $route) 
        {
            $pattern = str_replace('/', '\/', $route['path']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $request_path, $matches) && $route['method'] === $request_method) 
            {
                $callback = $route['handler'];
                $middlewares = $route['middlewares'];
                $path_params = $matches;
                array_shift($path_params);
                break;
            }
        }

        if (!$callback) 
        {
            header("HTTP/1.0 404 Not Found");
            return;
        }


        try  
        {
            foreach($middlewares as $middleware)
            {
                $parameters = array(&$path_params);
                call_user_func_array($middleware, $parameters);
            }
            call_user_func($callback, $path_params);
        }
        catch (ClientErrorException $cee)
        {
            BaseController::toResponse($cee->getResponseCode(),$cee->getMessage(), "", false);
        }
        catch (Exception $e)
        {
            BaseController::toResponse(500,"Something went wrong!", "", false);
        }

        // /*DEBUG*/
        // echo("PARAMS: " . json_encode($params) . "\n");
        // echo("QUERY STRING: " . json_encode($_SERVER['QUERY_STRING']) . "\n");
        // echo("_GET: " . json_encode($_GET) . "\n");
        // echo("file_get_contents('php://input'): " . json_encode(json_decode(file_get_contents('php://input'))) . "\n");

    }
}