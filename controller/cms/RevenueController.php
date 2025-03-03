<?php
class RevenueController extends Controller{

    function __construct() {
        parent::__construct();
        $this->_MODEL = new RevenueModel();
    }

    function index(){
        $revenues = $this->_MODEL->get('revenue');
        $this->_VIEW->render(['cms','revenue', 'index'], ['revenues' => $revenues]);
    }

    function add(){
        $procats = $this->_MODEL->get('procat');
        $sellers = $this->_MODEL->get('seller');
        $this->_VIEW->render(['cms','revenue', 'add'], ['procats' => $procats, 'sellers' => $sellers]);
    }

    function edit(){
        if( !empty( $_GET['id'] ) ){
            $revenue = $this->_MODEL->getRevenueByID($_GET['id']);
            $procats = $this->_MODEL->get('procat');

            $this->_VIEW->render(['cms','revenue', 'edit'],[
                'revenue' => $revenue,
                'procats' => $procats
            ]);
        }
    }

    function update(){
        if( !empty( $_POST ) ){
            if( !empty( $_FILES['revenue_thumbnail']['name'] ) ){
                $param['revenue_thumbnail'] = HelperUploadIMG($_FILES['revenue_thumbnail'], $_POST['revenue_category_name'], $_POST['revenue_name']);
            }

            $param['revenue_name'] = $_POST['revenue_name'];
            $param['revenue_price_input'] = str_replace('.', '',$_POST['revenue_price_input']);
            $param['revenue_price_output'] = str_replace('.', '',$_POST['revenue_price_output']);
            $param['revenue_category_id'] = $_POST['revenue_category'];
            $param['revenue_description'] = $_POST['revenue_description'];
            $param['revenue_quantity'] = $_POST['revenue_quantity'];
            $param['revenue_image_id'] = $_POST['revenue_image_id'];
            $param['revenue_created_at'] = date("d-m-Y");
            $param['revenue_updated_at'] = date("d-m-Y");

            $this->_MODEL->updateRevenue($param, $_GET['id']);
        }

        return $this->redirect('cms/revenue/index', ['success' => "Success"]);
    }

    function insert(){
        if( !empty( $_POST ) ){
            if( !empty( $_FILES['revenue_thumbnail']['name'] ) ){
                $param['revenue_thumbnail'] = HelperUploadIMG($_FILES['revenue_thumbnail'], $_POST['revenue_category_name'], $_POST['revenue_name']);
            }

            $param['revenue_name'] = $_POST['revenue_name'];
            $param['revenue_price_input'] = str_replace('.', '',$_POST['revenue_price_input']);
            $param['revenue_price_output'] = str_replace('.', '',$_POST['revenue_price_output']);
            $param['revenue_category_id'] = $_POST['revenue_category'];
            $param['revenue_description'] = $_POST['revenue_description'];
            $param['revenue_quantity'] = $_POST['revenue_quantity'];
            $param['revenue_image_id'] = $_POST['revenue_image_id'];
            $param['revenue_created_at'] = date("d-m-Y");
            $param['revenue_updated_at'] = date("d-m-Y");
            
            $this->_MODEL->insert('revenue', $param);
        }
        return $this->redirect('cms/revenue/index', ['success' => "Success"]);
    }

    function delete(){
        if( !empty( $_GET['id'] ) ){
            $revenue = $this->_MODEL->getRevenueByID($_GET['id']);
            if( !empty( $revenue ) ){
                $this->_MODEL->deleteRevenue($_GET['id']);
                HelperDeleteIMG($revenue['revenue_thumbnail']);
            }
        }
        return $this->redirect('cms/revenue/index', ['success' => "Success"]);
    }

}
?>
