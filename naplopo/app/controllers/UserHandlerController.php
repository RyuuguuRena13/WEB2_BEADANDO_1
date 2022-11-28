<?php

    class UserHandlerController extends Conn {
        protected $username;
        protected $email;
        protected $pass;
        protected $userType;
        protected $userID;

        public function __construct($userName = "", $email = "", 
        $pass = "", $userType = 0, $userID = 0) {
            $this->userName = $userName;
            $this->email = $email;
            $this->pass = $pass;
            $this->userType = $userType;
            $this->userID = $userID;
            
            parent::__construct();
        }

        public function CheckExists($field, $value, $update) {
            $sql = "SELECT UserID FROM users WHERE {$field} = ? ";

            if($update)
                $sql .= "AND UserID != ? ";

            $stmt = $this->conn->prepare($sql);

            if(!$update) {
                $stmt->execute([
                    $value
                ]);
            } else {
                $stmt->execute([
                    $value, 
                    $this->userID
                ]);
            }

            return $stmt->rowCount() >= 1 ? true : false;
        }

        protected function CheckErrors($update = false) {
            $errors = "";

            if(mb_strlen($this->userName) < 4)
                $errors .= "A felhasználónévnek minimum 4 karakteresnek kell lennie!|";
            if(!preg_match("/^[a-z\.\-\_\d]{2,30}(@)[a-z\.\-\_\d]{2,30}(\.)[a-z]{2,8}$/", $this->email))
                $errors .= "Az email cím nem megfelelő formátumú!|";
            if(!in_array($this->userType, [1,2,3]))
                $errors .= "Nem létezik ilyen felhasználó típus!|";
            if(mb_strlen($this->pass) < 8)
                $errors .= "A jelszónak legalább 8 karakteresnek kell lennie!|";
            if($this->CheckExists("UserName", $this->userName, $update))
                $errors .= "Már létezik ilyen felhasználónév a rendszerben!";
            if($this->CheckExists("Email", $this->email, $update))
                $errors .= "Már létezik ilyen email cím a rendszerben!";

            if(!empty($errors))
                throw new Exception($errors);
        }
    }

?>