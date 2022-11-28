<?php

    define("HTTP_VERSION", isset($_SERVER["HTTPS"]) ? "https://" : "http://");
    define("HOST", $_SERVER["HTTP_HOST"]);
    define("LOCALHOSTPATH", "/naplopo");

    function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    spl_autoload_register(function($className) {
        $path = "{$_SERVER["DOCUMENT_ROOT"]}/naplopo/app/controllers/{$className}.php";
        $path2 = "{$_SERVER["DOCUMENT_ROOT"]}/naplopo/app/models/{$className}.php";
        
        if(file_exists($path))
            require_once $path;
        else if(file_exists($path2))
            require_once $path2;
    });

?>