<?php
namespace app\core;


Class Router{

    public Request $request;
    public Response $response;
    protected array $routes = [];


    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path,$callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
//        print '<pre>';
//        print_r($_SERVER);
//        print '<pre>';
//        exit;

        $path   = $this->request->getPath();

        $method = $this->request->method();

//        print '<pre>';
//        var_dump($method);
//        print '</pre>';
//        exit;

        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false)
        {
            $this->response->setStatusCode(404);
            //Application::$app->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        if(is_array($callback))
        {
            Application::$app->controller = new $callback[0]();  // Instance of the controller new Controller;
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view , $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent   = $this->renderOnlyView($view , $params);
        return str_replace('{{content}}',$viewContent,$layoutContent);
        //$layout = Application::$app->controller->layout;
        //include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        //include_once Application::$ROOT_DIR."/views/$view.php";
        //include_once Application::$ROOT_DIR."/views/layouts/footer.php";
    }

    protected function layoutContent()
    {
        ob_start();
        if (isset(Application::$app->controller))
        {
            $layout = Application::$app->controller->layout;
            include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        }
        else
        {
            include_once Application::$ROOT_DIR."/views/layouts/main.php";
        }

       return ob_get_clean();
       
    }

    protected function renderOnlyView($view , $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value ;
//           $name = Subhadeep;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }


}


?>