<?php
class Controller{
    
    protected $_VIEW;
    protected $_MODEL;

    function __construct() {
        $this->_VIEW  = new View();
    }

    function redirect( $route, $message ){
        if(!empty( $message['success'] )){
            setcookie('successMessage', $message['success'], time()+(3600-3597), "/");
            header("Location: " . ROOT_URL . DS . $route);
        }

        if(!empty( $message['error'] )){
            setcookie('errorMessage', $message['error'], time()+(3600-3597), "/");
            header("Location: " . ROOT_URL . DS . $route);
        }
    }
    
}