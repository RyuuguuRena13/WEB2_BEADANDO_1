<?php

    require_once "../init.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["userName"]) && isset($_POST["pass"])) {
            $restApi = new RestApi();
            $restApi->GetArticles($_POST["userName"], $_POST["pass"]);
        } else {
            http_response_code(400);
            echo json_encode(["message"=>"Felhasználónév és jelszó beküldése szükséges!"]);
        }
    } else {
        http_response_code(405);
        echo json_encode(["message"=>"POST metódus használata szükséges!"]);
    }

?>