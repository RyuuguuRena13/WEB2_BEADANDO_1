<?php

    $errors = "";

    if(isset($_POST["registration"])) {
        $uh = new UserHandler(
            $_POST["userName"], $_POST["email"],
            $_POST["pass"], 1
        );

        try {
            $success = $uh->Registration();
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
    <h1>Regisztráció</h1>

    <form method="POST" class="box">
        <h3>Felhasználónév</h3>
        <input type="text" name="userName" class="input text-input input30p" placeholder="felhasználónév">

        <h3>Email cím</h3>
        <input type="text" name="email" class="input text-input input30p" placeholder="email cím">

        <h3>Jelszó</h3>
        <input type="password" name="pass" class="input text-input input30p" placeholder="jelszó">

        <button class="input btn" name="registration">Regisztráció!</button>
    </form>
</div>