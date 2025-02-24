<?php
class ProcatModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getProcatByID($id){
        $sql    = "SELECT * FROM procat WHERE procat_id = " . $id;
        $result = $this->_CONNECTION->query($sql);
        $procat = $result->fetch_array(MYSQLI_ASSOC);
        
        if( empty($procat) ){
            die('procat is not exists!');
        }
        return $procat;
    }

    function updateProcat($param, $id){
        $updateParam = $this->updateParam($param);
        $sql = "UPDATE procat SET $updateParam WHERE procat_id = " . $id;
        $this->excuseSQL($sql);
    }

    function deleteProcat($id){
        $sql = "DELETE FROM procat WHERE procat_id = " . $id;
        if( !$this->excuseSQL($sql) ){
            die('Can not delete procat!');
        }
    }


}