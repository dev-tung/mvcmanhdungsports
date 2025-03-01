<?php
class ProductModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getProductByID($id){
        $sql = "SELECT * FROM `product` p LEFT JOIN procat pc ON p.product_category_id = pc.procat_id WHERE product_id = $id";
  
        $result = $this->_CONNECTION->query($sql);
        $product = $result->fetch_array(MYSQLI_ASSOC);
        
        if( empty($product) ){
            die('product is not exists!');
        }
        return $product;
    }

    function getProductByProcatID($procat_id){
        $sql = "SELECT * FROM `product` WHERE procat_id = $procat_id";
  
        $result = $this->_CONNECTION->query($sql);
        $product = $result->fetch_all(MYSQLI_ASSOC);
        
        if( empty($product) ){
            die('product is not exists!');
        }
        return $product;
    }

    function updateProduct($param, $id){
        $updateParam = $this->updateParam($param);
        $sql = "UPDATE product SET $updateParam WHERE product_id = " . $id;
        $this->excuseSQL($sql);
    }

    function deleteProduct($id){
        // DD($procats);
        $sql = "DELETE FROM product WHERE product_id = " . $id;
        if( !$this->excuseSQL($sql) ){
            die('Can not delete product!');
        }
    }


}