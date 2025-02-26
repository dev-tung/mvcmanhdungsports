<?php
class ProcatController extends Controller{

    function __construct() {
        parent::__construct();
        $this->_MODEL = new ProcatModel();
    }

    function index(){
        $procats = $this->_MODEL->get('procat');
        // DD($procats);
        $this->_VIEW->render(['cms','procat', 'index'], ['procats' => $procats]);
    }

    function add(){
        $procats = $this->_MODEL->get('procat');
        $this->_VIEW->render(['cms','procat', 'add'], ['procats' => $procats]);
    }

    function insert(){
        if( !empty( $_POST ) ){
            $this->_MODEL->insert('procat', [
                'procat_parent_id' => $_POST['procat_parent_id']
               ,'procat_name' => $_POST['procat_name']
               ,'procat_description' => $_POST['procat_description']
           ]);
        }

        return $this->redirect('cms/procat/index', ['success' => "Success"]);
    }

    function edit(){
        if( !empty( $_GET['id'] ) ){
            $procat = $this->_MODEL->getProcatByID($_GET['id']);
            $procats = $this->_MODEL->get('procat');
            $this->_VIEW->render(['cms','procat', 'edit'],[
                'procat' => $procat, 
                'procats' => $procats
            ]);
        }
    }

    function update(){
        if( !empty( $_POST ) ){
            $this->_MODEL->updateProcat([
                'procat_parent_id' => $_POST['procat_parent_id']
               ,'procat_name' => $_POST['procat_name']
               ,'procat_description' => $_POST['procat_description']
           ], $_GET['id']);
        }

        return $this->redirect('cms/procat/index', ['success' => "Success"]);
    }

    function delete(){
        if( !empty( $_GET['id'] ) ){
            $this->_MODEL->deleteProcat($_GET['id']);
        }
        return $this->redirect('cms/procat/index', ['success' => "Success"]);
    }

}
?>
