<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <? foreach ($category as $categorylist) :?>
                <li class="promo__item promo__item--<? echo $categorylist['signcode']; ?>">
                    <a class="promo__link" href="pages/all-lots.html"><? echo htmlspecialchars($categorylist['name']); ?></a>
                </li>
        <? endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <? foreach ($list as $val): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<? echo htmlspecialchars($val['imgurl']);?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><? echo htmlspecialchars($val['name']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="<?= htmlspecialchars('lot.php?id='.$val['id']); ?>"><? echo htmlspecialchars($val['lotname']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><? echo htmlspecialchars(numform($val['firstprice'])); ?></span>
                        </div>
                        <div class="lot__timer timer <? echo  ($hours <= 1) ? "timer--finishing" : "";?>">
                            <? echo $hours; ?>
                        </div>
                    </div>
                </div>
            </li>
        <? endforeach; ?>
    </ul>
</section>