<?php

    require_once "../init.php";

    $ac = new ArticlesController();

    if(isset($_POST["articleID"]))
        echo json_encode($ac->GetComments($_POST["articleID"]));

?>