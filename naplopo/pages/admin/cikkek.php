<?php

    $errors = "";
    $articles = new Articles();

    if(isset($_POST["articleID"])) {
        try {
            $articles->DeleteArticle($_POST["articleID"]);
        } catch(Exception $ex) {
            $errors = ErrorDisplayer::ShowError($ex->getMessage());
        }
    }

    $articleData = $articles->GetArticlesAdmin();

?>

<?php if(!empty($_POST["articleIdBtn"])): ?>
    <form method="POST" class="message-box shadow">
        <div class="error-message-holder">
            <h3>Biztosan le akarod törölni a cikket?</h3>
        </div>
        <div class="message-box-btn-holder">
            <button class="input btn" name="articleID" value="<?=$_POST["articleIdBtn"]?>">Törlés!</button>
            <button class="input btn">Mégse</button>
        </div>
    </form>
<?php endif; ?>

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
    <h1>Cikkek</h1>

    <a class="input btn input20p" href="<?=$this->GetBaseUrl()?>?scene=admin&page=cikk">Cikk felvitele</a>

    <div class="grid-4">
        <?php foreach($articleData as $art): ?>
            <div class="box">
                <h3>Cím</h3>
                <h4><?=$art["Title"]?></h4>
                <h3>Szerző</h3>
                <h4><?=$art["UserName"]?></h4>
                <h3>Létrehozás dátuma</h3>
                <h4><?=$art["CreationDate"]?></h4>
                <h3>Módosítás dátuma</h3>
                <h4><?=$art["ModificationDate"] !== null ? $art["ModificationDate"] : "nem történt módosítás"?></h4>

                <a class="input btn input40p" href="<?=$this->GetBaseUrl()?>?scene=admin&page=cikk&article_id=<?=$art["ArticleID"]?>">Megnyitás</a>

                <form method="POST">
                    <button class="input btn" name="articleIdBtn" value="<?=$art["ArticleID"]?>">Törlés</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>