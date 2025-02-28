<?php
    define("DS", DIRECTORY_SEPARATOR);

    define('ROOT_PATH', realpath($_SERVER["DOCUMENT_ROOT"]));
    define("CONTROLLER_PATH", 'controller');
    define("API_PATH", 'api');
    define("MODEL_PATH", 'model');
    define("VIEW_PATH", 'view');
    define("ASSET_PATH", 'asset');
    define("LIBRARY_PATH", 'library');
    define("UPLOAD_PATH", 'upload');
    define("ROOT_URL", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']);

    // CMS
    define("VIEW_CMS_PATH", VIEW_PATH.DS.'cms');
    define("VIEW_CMS_PARTIAL_PATH", VIEW_CMS_PATH.DS.'partial');
?>