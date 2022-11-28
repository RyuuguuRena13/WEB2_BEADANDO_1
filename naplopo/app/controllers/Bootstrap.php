<?php

    class Bootstrap extends Conn {
        use Url;
        //melyik felülen vagyunk, melyik oldalon
        private $sceneAndPage = [];

        public function __construct() {
            $this->sceneAndPage = $this->GetSceneAndPage();
            parent::__construct();
        }

        public function HighlightMenu($menu) {
            if($this->sceneAndPage[1] == $menu)
                return "highlight-menu";
            return "";
        }

        public function LoadHead() {
            require_once "common/head.php";
        }

        public function GetMenus() {
            $attribute = $this->sceneAndPage[0] == "public" ? "PublicScene" : "AdminScene";
            $sql = "SELECT * FROM menu WHERE {$attribute} = ? ";

            if(!isset($_COOKIE["userType"]) || !in_array($_COOKIE["userType"], [2,3]))
                $sql .= "AND RestrictedPage = ? ";

            $stmt = $this->conn->prepare($sql);

            if(!isset($_COOKIE["userType"]) || !in_array($_COOKIE["userType"], [2,3]))
                $stmt->execute([1, 0]);
            else 
                $stmt->execute([1]);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }

        public function LoadHeader() {
            require_once "common/header.php";
        }

        public function LoadPage() {
            $fileName = "pages/{$this->sceneAndPage[0]}/{$this->sceneAndPage[1]}.php";

            if(file_exists($fileName))
                require_once $fileName;
            else 
                echo "<h1>A keresett oldal nem található!</h1>";
        }
    }

?>