<?php

    require_once "../init.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["userName"]) && isset($_POST["pass"]) && isset($_POST["articleID"])) {
            $restApi = new RestApi();
            $restApi->GetArticle($_POST["userName"], $_POST["pass"], $_POST["articleID"]);
        } else {
            http_response_code(400);
            echo json_encode(["message"=>"Felhasználónév, jelszó és cikk id beküldése szükséges!"]);
        }
    } else {
        http_response_code(405);
        echo json_encode(["message"=>"POST metódus használata szükséges!"]);
    }

?>