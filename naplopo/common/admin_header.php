<nav>
    <ul>
        <li>
            <a href="<?=$this->GetBaseUrl()?>">Kezdőlap</a>
        </li>
        <li class="<?=$this->HighlightMenu("beallitasok")?>">
            <a href="<?=$this->GetBaseUrl()?>?scene=admin&page=beallitasok">Beállítások</a>
        </li>
        <li class="<?=$this->HighlightMenu("cikkek")?>">
            <a href="<?=$this->GetBaseUrl()?>?scene=admin&page=cikkek">Cikkek</a>
        </li>
        <li>
            <a href="<?=$this->GetBaseUrl()?>?logout=true">Kijelentkezés</a>
        </li>
    </ul>
</nav>