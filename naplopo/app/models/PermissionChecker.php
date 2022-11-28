<?php

    class PermissionChecker {
        use Url;

        private $restrictedPages = [
            "cikkek", "cikk"
        ];
        private $sceneAndPage = [];

        public function __construct() {
            $this->sceneAndPage = $this->GetSceneAndPage();
        }

        public function CheckPagePermission() {
            if($this->sceneAndPage[0] != "admin")
                return;
            $baseUrl = $this->GetBaseUrl();
            if(!isset($_COOKIE["userType"]) || !isset($_COOKIE["userID"])) {
                header("location:{$baseUrl}");
            } else {
                if(in_array($this->sceneAndPage[1], $this->restrictedPages) 
                && !in_array($_COOKIE["userType"], [2,3])) {
                    header("location:{$baseUrl}");
                }
            }
        }

        public function CheckOperationPermission($permArray = [1,2,3]) {
            if(!isset($_COOKIE["userType"]) || !isset($_COOKIE["userID"]))
                throw new Exception("Ehhez a művelethez bejelentkezés szükséges!");

            if(!in_array($_COOKIE["userType"], $permArray))
                throw new Exception("Nincs jogosultságod a művelet elvégzéséhez!");
        }

        public function CheckApiPermission($userName, $pass) {
            $uh = new UserHandler($userName, "", $pass);

            $userData = $uh->CheckUserData();

            return $userData;
        }
    }

?>