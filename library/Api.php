<?php
class API{
    
    protected $_MODEL;
    protected $_REQUEST;

    function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: *');
        header('Content-Type: application/json; charset=UTF-8');
        $this->_REQUEST = json_decode(file_get_contents('php://input'));
    }
    
}