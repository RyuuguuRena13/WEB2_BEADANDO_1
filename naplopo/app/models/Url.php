<?php

    trait Url {
        public function GetBaseUrl() {
            return HTTP_VERSION . HOST . LOCALHOSTPATH;
        }

        public static function sGetBaseUrl() {
            return HTTP_VERSION . HOST . LOCALHOSTPATH;
        }

        public function GetSceneAndPage() {
            $scene = isset($_GET["scene"]) ? $_GET["scene"] : "public";
            $page = isset($_GET["page"]) ? $_GET["page"] : "home";

            return [$scene, $page];
        }
    }

?>