<?php
    function HelperUploadIMG($file, $category, $uploadFileName){
        $target_folder = UPLOAD_PATH.DS.$category;
        
        $target_file = $target_folder. DS . $uploadFileName . '.' .pathinfo($file["name"], PATHINFO_EXTENSION);
        //DD( $target_file );

        if (!file_exists($target_folder)) {
            mkdir($target_folder, 0777, true);
        }

        move_uploaded_file($file["tmp_name"], $target_file);
        return str_replace('\\', '/', $target_file);
    }

    function HelperDeleteIMG($filePath){
        unlink($filePath);
    }

    function DD($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
    

    