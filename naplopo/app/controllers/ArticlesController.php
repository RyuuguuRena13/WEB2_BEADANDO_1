<?php

    class ArticlesController extends Conn {
        protected $title;
        protected $shortDesc;
        protected $desc;
        protected $articleID;
        protected $pc;

        public function __construct($title = "", $shortDesc = "", 
        $desc = "", $articleID = 0) {
            $this->title = $title;
            $this->shortDesc = $shortDesc;
            $this->desc = $desc;
            $this->articleID = $articleID;
            $this->pc = new PermissionChecker();

            parent::__construct();
        }

        protected function CheckErrors() {
            $errors = "";

            if(mb_strlen($this->title) < 4)
                $errors .= "A címnek legalább 4 karakteresnek kell lennie!|";
            if(mb_strlen($this->shortDesc) < 10)
                $errors .= "A rövid leírásnak legalább 10 karakteresnek kell lennie!|";
            if(mb_strlen($this->desc) < 50)
                $errors .= "A leírásnak legalább 50 karakteresnek kell lennie!|";

            if(!empty($errors))
                throw new Exception($errors);
        }

        public function GetArticle($articleID) {
            $this->pc->CheckOperationPermission([2,3]);
            $sql = "SELECT * FROM articles WHERE ArticleID = ? ";

            if($_COOKIE["userType"] == 2)
                $sql .= "AND UserID = ?";

            $stmt = $this->conn->prepare($sql);

            if($_COOKIE["userType"] == 2) {
                $stmt->execute([
                    $articleID,
                    $_COOKIE["userID"]
                ]);
            } else {
                $stmt->execute([
                    $articleID
                ]);
            }

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row !== false ? $row : [];
        }

        public function GetArticlePublic($articleID) {
            $sql = "SELECT * FROM articles WHERE ArticleID = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                $articleID
            ]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row !== false ? $row : [];
        }

        public function GetArticlesAdmin() {
            $this->pc->CheckOperationPermission([2,3]);
            $sql = "SELECT articles.*, users.UserName 
            FROM articles 
            INNER JOIN users 
            ON articles.UserID = users.UserID ";

            if($_COOKIE["userType"] == 2)
                $sql .= "WHERE users.UserID = ?";

            $stmt = $this->conn->prepare($sql);

            if($_COOKIE["userType"] == 2) {
                $stmt->execute([
                    $_COOKIE["userID"]
                ]);
            } else {
                $stmt->execute();
            }

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        public function GetArticles() {
            $stmt = $this->conn->query("SELECT articles.*, 
            users.UserName
            FROM users
            INNER JOIN articles 
            ON articles.UserID = users.UserID");

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        public function GetComments($articleID) {
            $stmt = $this->conn->prepare("SELECT comments.*, users.UserName 
            FROM comments
            INNER JOIN  users
            ON users.UserID = comments.UserID
            WHERE ArticleID = ? ORDER BY CreationDate DESC");
            $stmt->execute([$articleID]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }
    }

?>