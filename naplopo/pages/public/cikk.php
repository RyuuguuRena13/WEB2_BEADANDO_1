<?php

    $ac = new ArticlesController();
    $articleID = isset($_GET["article_id"]) && is_numeric($_GET["article_id"]) ? $_GET["article_id"] : 0;
    $articleData = $ac->GetArticlePublic($articleID);

?>

<div class="content">
    <div class="box">
        <?php if(!empty($articleData)): ?>
            <h1><?=$articleData["Title"]?></h1>
            <p>
                <?=$articleData["Description"]?>
            </p>
               
            <strong>Létrehozás: <?=$articleData["CreationDate"]?></strong>
        <?php endif; ?>
    </div>

    <div class="box center-text">
        <h2>Kommentek</h2>
        <?php if(isset($_COOKIE["userID"])): ?>
            <form>
                <textarea class="input text-input input80p" id="comment"
                rows="5" placeholder="írd ide a kommentedet!"></textarea>

                <button type="button" class="input btn" id="setComment">Küldés!</button>
            </form>
        <?php endif; ?>

        <div id="comments"></div>
    </div>

    <script src="<?=$this->GetBaseUrl()?>/assets/scripts/main.js"></script>
    <script src="<?=$this->GetBaseUrl()?>/assets/scripts/comments.js"></script>
</div>