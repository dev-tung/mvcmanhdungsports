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
            if( !empty( $_FILES['product_thumbnail']['name'] ) ){
                $param['product_thumbnail'] = HelperUploadIMG($_FILES['product_thumbnail'], $_POST['product_category_name'], $_POST['product_name']);
            }

            $param['product_name'] = $_POST['product_name'];
            $param['product_price_input'] = str_replace('.', '',$_POST['product_price_input']);
            $param['product_price_output'] = str_replace('.', '',$_POST['product_price_output']);
            $param['product_category_id'] = $_POST['product_category'];
            $param['product_description'] = $_POST['product_description'];
            $param['product_quantity'] = $_POST['product_quantity'];
            $param['product_image_id'] = $_POST['product_image_id'];
            $param['product_created_at'] = date("d-m-Y");
            $param['product_updated_at'] = date("d-m-Y");

            $this->_MODEL->updateProduct($param, $_GET['id']);
        }

        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

    function insert(){
        if( !empty( $_POST ) ){
            if( !empty( $_FILES['product_thumbnail']['name'] ) ){
                $param['product_thumbnail'] = HelperUploadIMG($_FILES['product_thumbnail'], $_POST['product_category_name'], $_POST['product_name']);
            }

            $param['product_name'] = $_POST['product_name'];
            $param['product_price_input'] = str_replace('.', '',$_POST['product_price_input']);
            $param['product_price_output'] = str_replace('.', '',$_POST['product_price_output']);
            $param['product_category_id'] = $_POST['product_category'];
            $param['product_description'] = $_POST['product_description'];
            $param['product_quantity'] = $_POST['product_quantity'];
            $param['product_image_id'] = $_POST['product_image_id'];
            $param['product_created_at'] = date("d-m-Y");
            $param['product_updated_at'] = date("d-m-Y");
            
            $this->_MODEL->insert('product', $param);
        }
        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

    function delete(){
        if( !empty( $_GET['id'] ) ){
            $product = $this->_MODEL->getProductByID($_GET['id']);
            if( !empty( $product ) ){
                $this->_MODEL->deleteProduct($_GET['id']);
                HelperDeleteIMG($product['product_thumbnail']);
            }
        }
        return $this->redirect('cms/product/index', ['success' => "Success"]);
    }

}
?>
