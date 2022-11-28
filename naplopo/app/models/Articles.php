<?php

    class Articles extends ArticlesController {
        use Url;

        public function SetArticle() {
            $this->CheckErrors();

            $this->pc->CheckOperationPermission([2,3]);
            $stmt = $this->conn->prepare("INSERT INTO articles 
            (Title, ShortDesc, Description, UserID)
            VALUES(?,?,?,?)");

            $stmt->execute([
                $this->title, 
                $this->shortDesc,
                $this->desc,
                $_COOKIE["userID"]
            ]);

            header("location:{$this->GetBaseUrl()}?scene=admin&page=cikk&article_id={$this->conn->lastInsertId()}");
        }

        public function ModifyArticle() {
            $this->pc->CheckOperationPermission([2,3]);
            $sql = "UPDATE articles 
            SET Title = ?, ShortDesc = ?, 
            Description = ?, ModificationDate = ?
            WHERE ArticleID = ? ";

            if($_COOKIE["userType"] == 2)
                $sql .= "AND UserID = ?";

            $stmt = $this->conn->prepare($sql);

            if($_COOKIE["userType"] == 2) {
                $stmt->execute([
                    $this->title, 
                    $this->shortDesc,
                    $this->desc,
                    date("Y-m-d H:i:s"),
                    $this->articleID,
                    $_COOKIE["userID"]
                ]);
            } else {
                $stmt->execute([
                    $this->title, 
                    $this->shortDesc,
                    $this->desc,
                    date("Y-m-d H:i:s"),
                    $this->articleID
                ]);
            }

            return true;
        }

        public function DeleteArticle($articleID) {
            $this->pc->CheckOperationPermission([2,3]);
            $sql = "DELETE FROM articles
            WHERE ArticleID = ? ";

            if($_COOKIE["userType"] == 2)   
                $sql .= "AND UserID = ? ";

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
        }

        public function SetComment($articleID, $comment) {
            $this->pc->CheckOperationPermission();

            if(empty($comment))
                throw new Exception("A komment nem lehet üres!");

            $stmt = $this->conn->prepare("INSERT INTO comments 
            (ArticleID, UserID, CommentText) 
            VALUES(?,?,?)");

            $stmt->execute([
                $articleID,
                $_COOKIE["userID"],
                $comment
            ]);

            return true;
        }
    }

?>