<?php
class ProductController extends Controller{

    function __construct() {
        parent::__construct();
    }

    function index(){
        $products = $this->_MODEL->get('product');
        // HelperDD($products);
        $this->_VIEW->render(['cms','product', 'index'], ['products' => $products]);
    }

    function add(){
        $this->_VIEW->render(['cms','product', 'add']);
    }

    function insert(){
        if( !empty( $_POST ) ){
            $this->_MODEL->insert('product', [
                'product_id' => 1
               ,'product_name' => $_POST['product_name']
               ,'product_price_input' => $_POST['product_price_input']
               ,'product_price_output' => $_POST['product_price_output']
               ,'product_category_id' => $_POST['product_category']
               ,'product_description' => $_POST['product_description']
               ,'product_quantity' => $_POST['product_quantity']
               ,'product_thumbnail' => $_POST['product_thumbnail']
               ,'product_image_id' => $_POST['product_thumbnail']
               ,'product_created_at' => date("d-m-Y")
               ,'product_updated_at' => date("d-m-Y")
           ]);
        }

    }

}
?>
