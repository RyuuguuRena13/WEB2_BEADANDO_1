<?php

    class ErrorDisplayer {
        public static function ShowError($errors) {
            $errorsArray = explode("|", $errors);
            $errorsHTML = "";

            foreach($errorsArray as $err) {
                $errorsHTML .= "<h4>{$err}</h4>";
            }

            return $errorsHTML;
        }
    }

?>