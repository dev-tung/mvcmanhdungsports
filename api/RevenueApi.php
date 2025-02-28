<?php
class RevenueApi extends Api{

    function __construct() {
        $this->_MODEL = new RevenueModel();
    }

    function get(){
        echo json_encode([
            'success' => true,
            'data' => $this->_MODEL->get('revenue')
        ]);
    }


}
?>
