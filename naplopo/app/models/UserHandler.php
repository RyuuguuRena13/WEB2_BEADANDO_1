<?php

    class UserHandler extends UserHandlerController {
        use Url;

        public function Registration() {
            $this->CheckErrors();

            $stmt = $this->conn->prepare("INSERT INTO users
            (UserName, Email, Pass, UserType) 
            VALUES(?,?,?,?)");

            $stmt->execute([
                $this->userName, 
                $this->email, 
                hash("sha512", $this->pass),
                $this->userType
            ]);

            return true;
        }

        public function CheckUserData() {
            $stmt = $this->conn->prepare("SELECT * FROM users 
            WHERE (UserName = ? AND Pass = ?) OR (Email = ? AND Pass = ?)");

            $stmt->execute([
                $this->userName, hash("sha512", $this->pass),
                $this->email, hash("sha512", $this->pass),
            ]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return [$row, $stmt->rowCount()];
        }

        public function Login() {
            $userData = $this->CheckUserData();
            $row = $userData[0];

            if($userData[1] == 1) {
                setcookie("userID", $row["UserID"], time()+86400, "/", "", false, true);
                setcookie("userType", $row["UserType"], time()+86400, "/", "", false, true);

                if($row["UserType"] == 2 || $row["UserType"] == 3)
                    header("location:{$this->GetBaseUrl()}?scene=admin&page=cikkek");
                else 
                    header("location:{$this->GetBaseUrl()}?scene=public&page=home");
            } else {
                throw new Exception("Nem megfelelő felhasználónév/jelszó páros!");
            }
        }

        public static function Logout() {
            if(isset($_GET["logout"])) {
                setcookie("userID", 0, time()-5, "/", "", false, true);
                setcookie("userType", 0, time()-5, "/", "", false, true);
                $baseUrl = self::sGetBaseUrl();
                header("location:{$baseUrl}");
            }
        }
    }

?>