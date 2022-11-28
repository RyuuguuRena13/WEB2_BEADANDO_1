<nav>
    <ul>
        <li class="<?=$this->HighlightMenu("home")?>">
            <a href="<?=$this->GetBaseUrl()?>">Kezdőlap</a>
        </li>

        <?php if(!isset($_COOKIE["userID"])): ?>
            <li class="<?=$this->HighlightMenu("bejelentkezes")?>">
                <a href="<?=$this->GetBaseUrl()?>?scene=public&page=bejelentkezes">Bejelentkezés</a>
            </li>
            <li class="<?=$this->HighlightMenu("regisztracio")?>">
                <a href="<?=$this->GetBaseUrl()?>?scene=public&page=regisztracio">Regisztráció</a>
            </li>
        <?php else: ?>
            <li class="<?=$this->HighlightMenu("beallitasok")?>">
                <a href="<?=$this->GetBaseUrl()?>?scene=admin&page=beallitasok">Beállítások</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<header></header>