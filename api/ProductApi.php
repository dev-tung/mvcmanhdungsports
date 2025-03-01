<?php
class ProductApi extends Api{

    function __construct() {
        parent::__construct();
        $this->_MODEL = new ProductModel();
    }

    function get(){
        // $this->_REQUEST;
        $products = $this->_MODEL->getProductByProcatID($this->_REQUEST->procat_id);
        echo json_encode([
            'data' => $products
        ]);
    }


}
?>
