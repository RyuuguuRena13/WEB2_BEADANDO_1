<?php

    $errors = "";

    if(isset($_POST["login"])) {
        $uh = new UserHandler(
            $_POST["userName"], 
            $_POST["userName"],
            $_POST["pass"]
        );

        try {
            $success = $uh->Login();
            if($success)
                $errors = "<h3>Sikeres regisztráció!</h3>";
        } catch(Exception $ex) {
            $errors = ErrorDisplayer::ShowError($ex->getMessage());
        }
    }

?>

<?php if(!empty($errors)): ?>
    <form method="POST" class="message-box shadow">
        <div class="error-message-holder">
            <?=$errors?>
        </div>
        <div class="message-box-btn-holder">
            <button class="input btn">OK!</button>
        </div>
    </form>
<?php endif; ?>

<div class="content center-text">
    <h1>Bejelentkezés</h1>

    <form method="POST" class="box">
        <h3>Felhasználónév/email cím</h3>
        <input type="text" name="userName" class="input text-input input30p" placeholder="felhasználónév/email cím">

        <h3>Jelszó</h3>
        <input type="password" name="pass" class="input text-input input30p" placeholder="jelszó">

        <button name="login" class="input btn">Bejelentkezés</button>
    </form>
</div>