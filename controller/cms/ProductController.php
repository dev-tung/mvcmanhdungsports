<?php
class ProductController extends Controller{

    function __construct() {
        parent::__construct();
        $this->_MODEL = new ProductModel();
    }

    function index(){
        $products = $this->_MODEL->get('product');
        $this->_VIEW->render(['cms','product', 'index'], ['products' => $products]);
    }

    function add(){
        $procats = $this->_MODEL->get('procat');
        $this->_VIEW->render(['cms','product', 'add'], ['procats' => $procats]);
    }

    function edit(){
        if( !empty( $_GET['id'] ) ){
            $product = $this->_MODEL->getProductByID($_GET['id']);
            $procats = $this->_MODEL->get('procat');

            $this->_VIEW->render(['cms','product', 'edit'],[
                'product' => $product,
                'procats' => $procats
            ]);
        }
    }

    function update(){
        if( !empty( $_POST ) ){
            $this->_MODEL->updateProduct([
                'product_name' => $_POST['product_name']
               ,'product_price_input' => $_POST['product_price_input']
               ,'product_price_output' => $_POST['product_price_output']
               ,'product_category_id' => $_POST['product_category']
               ,'product_description' => $_POST['product_description']
               ,'product_quantity' => $_POST['product_quantity']
               ,'product_thumbnail' => $_POST['product_thumbnail']
               ,'product_image_id' => $_POST['product_thumbnail']
               ,'product_updated_at' => date("d-m-Y")
           ], $_GET['id']);
        }

        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

    function insert(){
        HelperUploadIMG(UPLOAD_PATH.DS, 'product_thumbnail');

        if( !empty( $_POST ) ){
            $this->_MODEL->insert('product', [
                'product_name' => $_POST['product_name']
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
        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

    function delete(){
        if( !empty( $_GET['id'] ) ){
            $this->_MODEL->deleteProduct($_GET['id']);
        }
        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

}
?>
