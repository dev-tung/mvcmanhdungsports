<?php
class CustomerModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getCustomerByID($id){
        $sql = "SELECT * FROM `customer` p LEFT JOIN procat pc ON p.customer_category_id = pc.procat_id WHERE customer_id = $id";
  
        $result = $this->_CONNECTION->query($sql);
        $customer = $result->fetch_array(MYSQLI_ASSOC);
        
        if( empty($customer) ){
            die('customer is not exists!');
        }
        return $customer;
    }

    function getCustomerByProcatID($procat_id){
        $sql = "SELECT * FROM `customer` WHERE procat_id = $procat_id";
  
        $result = $this->_CONNECTION->query($sql);
        $customer = $result->fetch_all(MYSQLI_ASSOC);
        
        if( empty($customer) ){
            die('customer is not exists!');
        }
        return $customer;
    }

    function updateCustomer($param, $id){
        $updateParam = $this->updateParam($param);
        $sql = "UPDATE customer SET $updateParam WHERE customer_id = " . $id;
        $this->excuseSQL($sql);
    }

    function deleteCustomer($id){
        // DD($procats);
        $sql = "DELETE FROM customer WHERE customer_id = " . $id;
        if( !$this->excuseSQL($sql) ){
            die('Can not delete customer!');
        }
    }


}