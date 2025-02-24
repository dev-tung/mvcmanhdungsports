<?php
class Model {
    private   $_SERVER   = "localhost";
    private   $_USERNAME = "root";
    private   $_PASSWORD = "";
    private   $_DATABASE = "manhdungsports";
    protected $_CONNECTION = NULL;

    function __construct() {
        $this->connectDatabase();
    }

    function connectDatabase(){
        // Create connection
        $this->_CONNECTION = new mysqli($this->_SERVER, $this->_USERNAME, $this->_PASSWORD, $this->_DATABASE);
        // Check connection
        if ($this->_CONNECTION->connect_error) {
            die("Connection failed: " . $this->_CONNECTION->connect_error);
        }
    }

    function insert($table, $data){
        $field = implode(',', array_keys($data));
        $value = implode("','", $data);
        $sql = "INSERT INTO $table ($field) VALUES ('$value')";
        // HelperDD($sql);
        return $this->excuseSQL($sql);
    }

    function updateParam($params){
        $cols_new = '';
        foreach ($params as $key => $value) {
            $cols_new .= $key . " = '" . $value . "', ";
        }
        return substr($cols_new, 0, -2);
    }

    function excuseSQL($sql){
        if ($this->_CONNECTION->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->_CONNECTION->error;
            die();
        }
        $this->_CONNECTION->close();
    }

    function get($table){
        $sql = "SELECT * FROM $table";
        $result = $this->_CONNECTION->query($sql);
        if($result){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return NULL;
    }
}