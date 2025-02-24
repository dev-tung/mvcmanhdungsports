<?php
class View {

    private $_DATA;

    private $_PAGE_TITLE = NULL;

    function __construct() {
    }

    function asset( $path ){
        $link = ROOT_URL . DS . ASSET_PATH . DS . $path;
        $link = str_replace('\\','/', $link);
        return $link; 
    }

    function render( $arrayPath, $data = NULL ){
        if( !empty( $data ) ){
            $this->_DATA = $data;
        }
        
        $viewPath = VIEW_PATH . DS . implode(DS, $arrayPath) . '.php';
        // HelperDD($viewPath);
        if( !file_exists( $viewPath ) ){
            die('View file is not exists!');
        }
        require_once $viewPath;
    }

    function route( $value, $param = NULL ){
       
        $paramURL = !empty( $param ) ? '?'.http_build_query($param, null, '/') : '';
        //HelperDD($data);
        return ROOT_URL . DS . $value . $paramURL;
    }

    function getCmsHeader( $pageTitle = NULL ){
        $this->_PAGE_TITLE = $pageTitle;
        require_once VIEW_CMS_PARTIAL_PATH.DS.'header.php';
    }

    function getCmsFooter(){
        require_once VIEW_CMS_PARTIAL_PATH.DS.'footer.php';
    }

}