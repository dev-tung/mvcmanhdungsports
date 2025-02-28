<?php
class ProductApi extends Api{

    function __construct() {
        $this->_MODEL = new ProductModel();
    }

    function get(){
        echo json_encode([
            'success' => true,
            'data' => $this->_MODEL->get('product')
        ]);
    }


}
?>
