<?php
    $menus = $this->GetMenus();
?>

<nav>
    <ul>
        <?php foreach($menus as $menu): ?>
            <li class="<?=$this->HighlightMenu($menu["MenuUrl"])?>">
                <a href="<?=$this->GetBaseUrl()?>?scene=<?=$menu["Scene"]?>&page=<?=$menu["MenuUrl"]?>">
                    <?=$menu["MenuName"]?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if($this->sceneAndPage[0] == "admin"): ?>
            <li>
                <a href="<?=$this->GetBaseUrl()?>?logout=true">Kijelentkezés</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>