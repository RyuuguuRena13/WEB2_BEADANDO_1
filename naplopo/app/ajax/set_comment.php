<?php

    require_once "../init.php";

    if(isset($_POST["articleID"]) && isset($_POST["comment"])) {
        $article = new Articles();

        try {
            echo json_encode($article->SetComment($_POST["articleID"], $_POST["comment"]));
        } catch(Exception $ex) {
            echo json_encode($ex->getMessage());
        }
    }

?>