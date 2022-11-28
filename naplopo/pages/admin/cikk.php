<?php

    $errors = "";

    $ac = new ArticlesController();
    $articleID = isset($_GET["article_id"]) && is_numeric($_GET["article_id"]) ? $_GET["article_id"] : 0;

    if(isset($_POST["setArticle"])) {
        $article = new Articles(
            $_POST["title"], 
            $_POST["shortDesc"],
            $_POST["description"]
        );

        try {
            $article->SetArticle();
        } catch(Exception $ex) {
            $errors = ErrorDisplayer::ShowError($ex->getMessage());
        }
    }

    if(isset($_POST["modifyArticle"])) {
        $article = new Articles(
            $_POST["title"], 
            $_POST["shortDesc"],
            $_POST["description"],
            $articleID
        );

        try {
            $success = $article->ModifyArticle();
            if($success)
                $errors = "<h3>Sikeres módosítás!</h3>";
        } catch(Exception $ex) {
            $errors = ErrorDisplayer::ShowError($ex->getMessage());
        }
    }
    
    $articleData = $ac->GetArticle($articleID);

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
    <h1>Cikk felvitele/módosítása</h1>
    
    <form method="POST" class="box">
        <h3>Cikk címe</h3>
        <input type="text" class="input text-input input50p" 
        value="<?=isset($articleData["Title"]) ? $articleData["Title"] : ""?>"
        name="title" placeholder="cikk címe">

        <h3>Rövid leírás</h3>
        <textarea name="shortDesc" placeholder="rövid leírás"
        class="input text-input input50p" rows="3"><?=isset($articleData["ShortDesc"]) ? $articleData["ShortDesc"] : ""?></textarea>

        <h3>Leírás</h3>
        <textarea name="description" placeholder="leírás"
        class="input text-input input50p" rows="10"><?=isset($articleData["Description"]) ? $articleData["Description"] : ""?></textarea>

        <?php if(!isset($_GET["article_id"])): ?>
            <button class="input btn" name="setArticle">Felvitel</button>
        <?php else: ?>
            <button class="input btn" name="modifyArticle">Felülírás</button>
        <?php endif; ?>
    </form>
</div>