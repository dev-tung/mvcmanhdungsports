<?php
class HomeController extends Controller{

    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->_VIEW->render(['web','home', 'index']);
    }

    function insert(){
        $this->_MODEL->insert('product', [
            'product_id' => 1
           ,'product_name' => 1
           ,'product_price_input' => 1
           ,'product_price_output' => 1
           ,'product_category_id' => 1
           ,'product_description' => 1
           ,'product_quantity' => 1
           ,'product_thumbnail' => 1
           ,'product_image_id' => 1
           ,'product_created_at' => 1
           ,'product_updated_at' => 1
       ]);
    }

}
?>