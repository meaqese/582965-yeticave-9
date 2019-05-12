<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php
        $i = 0;
        while ($i < count($category)): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?php echo htmlspecialchars($category[$i]); $i++; ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($list as $val): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?php echo htmlspecialchars($val['picture']);?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?php echo htmlspecialchars($val['category']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?php echo htmlspecialchars($val['name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?php echo htmlspecialchars(numform($val['price'])); ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer <?php echo  ($hours <= 1) ? "timer--finishing" : "";?>">
                            <?php echo $hours; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
