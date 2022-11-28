<?php

    class RestApi extends Conn {
        private $pc;

        function __construct() {
            $this->pc = new PermissionChecker();
            parent::__construct();
        }

        public function GetArticles($userName, $pass) {
            $userData = $this->pc->CheckApiPermission($userName, $pass);

            if($userData[1] != 1) {
                http_response_code(401);
                echo json_encode(["message"=>"Nem megfelelő felhasználónév/jelszó páros!"]);
                return;
            }

            $sql = "SELECT articles.*, users.UserName 
            FROM articles 
            INNER JOIN users 
            ON articles.UserID = users.UserID ";

            if($userData[0]["UserType"] == 2)
                $sql .= "WHERE users.UserID = ?";

            $stmt = $this->conn->prepare($sql);

            if($userData[0]["UserType"] == 2) {
                $stmt->execute([
                    $userData[0]["UserID"]
                ]);
            } else {
                $stmt->execute();
            }

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode($rows);
        }

        public function GetArticle($userName, $pass, $articleID) {
            $userData = $this->pc->CheckApiPermission($userName, $pass);

            if($userData[1] != 1) {
                http_response_code(401);
                echo json_encode(["message"=>"Nem megfelelő felhasználónév/jelszó páros!"]);
                return;
            }

            $sql = "SELECT * FROM articles WHERE ArticleID = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $articleID
            ]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $row = $row !== false ? $row : [];

            if(isset($row["UserID"]) && $row["UserID"] != $userData[0]["UserID"]) {
                http_response_code(403);
                echo json_encode(["message"=>"Nincs jogosultságod megtekinteni ezt a cikket!"]);
                return;
            }

            echo json_encode($row);
        }
    }

?>