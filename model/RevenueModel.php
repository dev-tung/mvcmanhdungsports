<?php
class RevenueModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getRevenueByID($id){
        $sql = "SELECT * FROM `revenue` p LEFT JOIN procat pc ON p.revenue_category_id = pc.procat_id WHERE revenue_id = $id";
  
        $result = $this->_CONNECTION->query($sql);
        $revenue = $result->fetch_array(MYSQLI_ASSOC);
        
        if( empty($revenue) ){
            die('revenue is not exists!');
        }
        return $revenue;
    }

    function updateRevenue($param, $id){
        $updateParam = $this->updateParam($param);
        $sql = "UPDATE revenue SET $updateParam WHERE revenue_id = " . $id;
        $this->excuseSQL($sql);
    }

    function deleteRevenue($id){
        // DD($procats);
        $sql = "DELETE FROM revenue WHERE revenue_id = " . $id;
        if( !$this->excuseSQL($sql) ){
            die('Can not delete revenue!');
        }
    }


}