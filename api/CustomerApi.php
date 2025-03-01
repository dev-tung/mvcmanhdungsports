<?php
class CustomerApi extends Api{

    function __construct() {
        parent::__construct();
        $this->_MODEL = new CustomerModel();
    }

    function get(){
        // $this->_REQUEST;
        $customers = $this->_MODEL->get('customer');
        echo json_encode([
            'data' => $customers
        ]);
    }


}
?>
