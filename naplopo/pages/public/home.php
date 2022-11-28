<?php

    $ac = new ArticlesController();
    $articles = $ac->GetArticles();

?>

<div class="content">
    <body>
    <section>
    <article>
      <h2>Tisztelt Érdeklődő!</h2>

      <p>A Kecskeméti Főiskola GAMF Kara 2014-ben ünnepelte az 50. évfordulóját annak, hogy Felsőfokú Gépipari Technikum
        néven megkezdte működését. Az intézmény 1969-ben kapott főiskolai rangot, amely azóta a Dél-alföldi Régió
        meghatározó felsőoktatási intézménye, oktatási-kutatási központja.<br>

        Bármerre járunk az országban, nagyvállalatoknál, kis- és középvállalkozásoknál egyaránt találkozhatunk a GAMF-on
        végzett gépészmérnökökkel, műszaki menedzserekkel, mérnökinformatikusokkal, akik nem ritkán vezető beosztásban
        dolgoznak, ha éppen nem saját cégük, vállalkozásuk irányítói. A GAMF olyan márkanévvé vált az elmúlt fél
        évszázad
        alatt, ami nem csak a legjobb ajánlólevél a karon végzett hallgatók számára, hanem garancia a korszerű tudásra,
        a
        fejlődés, az önképzés képességére. Karunknak van mire alapoznia, amikor új kihívásokkal kerül szembe.<br>

        Kecskemét és környéke ma az egyik legdinamikusabban fejlődő régiója az országnak, amely 2012 óta – a kormány
        döntése alapján – Kiemelt Járműipari Központ. A térség gazdasági szerepének erősödésével felértékelődött
        intézményünk oktatási és tudományos tevékenysége is. Mi is átvettük a magasabb fordulatszámot, és nagyszabású
        fejlesztési tevékenységbe kezdtünk. Megteremtettük, többek között, a járműipari tudományterület
        infrastrukturális
        hátterét és 2012-ben beindítottuk a járműmérnök-képzést. A német modell magyarországi adaptálásával – elsőként
        az
        országban –, a partnercégekkel szoros együttműködésben bevezettük a duális típusú képzést, amely minden
        eddiginél
        jobban megfelel a gazdaság elvárásainak. Mindemellett kialakítottuk a kutatás-fejlesztési tevékenység korszerűen
        felszerelt új bázisát, az Akkreditált Anyagvizsgáló és Méréstechnikai Laboratóriumot.<br>

        Karunk a képzési és kutatási portfólió további bővítésével olyan komplex kínálatot nyújt, amire megalapozottan
        építhetnek a térség vállalatai. A hagyományos mérnöki és informatikai képzéseink mellett karunkon indult be egy
        majdani új gazdasági kar első képzése, a gazdálkodási és menedzsment alapszak, a következő tanévtől pedig –
        eleget
        téve a vállalatok elvárásainak – már logisztikai mérnök szakon is tanulhatnak hallgatóink.<br>

        Büszkék vagyunk arra, amit eddig elértünk, s arra is, hogy eredményeinkben egy széles körű partnerség
        tükröződik.
        Kis- és középvállalatok, nagyvállalatok, szakmai szervezetek, intézmények, önkormányzatok alkotják azt a
        „szövetet” együtt karunkkal, amely garanciája a közös, sikeres jövőnek.<br>

        2016. július 1-jétől új fejezet kezdődött a GAMF történetében: a márkanevet megőrizve GAMF Műszaki és
        Informatikai
        Kar néven a Pallasz Athéné Egyetem karaként, 2017 augusztus 1-jétől pedig Neumann János Egytem karaként
        folytatjuk
        a munkát sok-sok tervvel és bizakodással nézve a jövőre, mert a GAMF „lényege” – meggyőződéssel állítom –
        ezentúl
        is változatlan. - Dr. Kovács Lóránt, dékán - <br>
      </p>
      <img src="assets/images/gamf.JPG" alt="Gamf kép">
    </article>
  </section>
</body>
    <div class="grid-4">
        <?php foreach($articles as $art): ?>
            <div class="box center-text">
                <h3>Cím</h3>
                <h4><?=$art["Title"]?></h4>
                <h3>Szerző</h3>
                <h4><?=$art["UserName"]?></h4>
                <h3>Létrehozás dátuma</h3>
                <h4><?=$art["CreationDate"]?></h4>
                <h3>Módosítás dátuma</h3>
                <h4><?=$art["ModificationDate"] !== null ? $art["ModificationDate"] : "nem történt módosítás"?></h4>
                <p>
                    <?=$art["ShortDesc"]?>
                </p>
                <a class="input btn input40p" href="<?=$this->GetBaseUrl()?>?scene=public&page=cikk&article_id=<?=$art["ArticleID"]?>">Megnyitás</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>