<?php
namespace app\core;

Class Application{

	public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static Application $app;

    public static string $ROOT_DIR;
	public function __construct($rootPath)
	{
        self::$ROOT_DIR = $rootPath;
        self::$app      = $this;    // Router.php line 49

        $this->request = new Request();
        $this->response = new Response();
		$this->router = new Router($this->request , $this->response);

	}

    public function run()
    {
        echo $this->router->resolve();

    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }


}


?>