<?php
class Init {
    private $_M = 'web';
    private $_C = 'home';
    private $_A = 'index';

    function __construct() {
        $this->session();
        $this->URL();
        $this->library();
        $this->model();
        $this->controller();
    }

    function session(){
        session_start();
    }

    function URL(){
        $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlComponent = parse_url($url)['path'];
        $urlComponent = explode( "/" , $urlComponent );

        if( !empty( $urlComponent[1] ) && !empty($urlComponent[2]) && !empty($urlComponent[3]) ){
            $this->_M = $urlComponent[1];
            $this->_C = $urlComponent[2];
            $this->_A = $urlComponent[3];
        }
    }

    function library(){
        include LIBRARY_PATH.DS.'Helper.php';
        include LIBRARY_PATH.DS.'Model.php';
        include LIBRARY_PATH.DS.'Controller.php';
        include LIBRARY_PATH.DS.'View.php';

        
        // HelperDD($actionName);
    }

    function controller(){
        $actionName = $this->_A;

        $controllerClass = ucfirst($this->_C).'Controller';

        $controllerFile = CONTROLLER_PATH.DS.$this->_M.DS.$controllerClass.'.php';
        if( !file_exists($controllerFile) ){
            die('Controller is not exists!');
        }

        require_once $controllerFile;
        $controller = new $controllerClass();

        if( !method_exists($controller, $actionName) ){
            die('Method is not exists!');
        }
        $controller->$actionName();
    }

    function model(){
        $modelClass = ucfirst($this->_C).'Model';
        
        $modelFile = MODEL_PATH . DS . $this->_M . DS . $modelClass .'.php';

        if( !file_exists($modelFile) ){
            die('Model is not exists!');
        }
        require_once $modelFile;
    }

}