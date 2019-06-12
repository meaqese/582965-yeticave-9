<?php
    $bidscount = mysqli_num_rows($bids);
?>
<main>
	<nav class="nav">
		<ul class="nav__list container">
			<?php foreach ($categories as $category): ?>
			<li class="nav__item">
				<a href="all-lots.html"><?= htmlspecialchars($category['name']); ?></a>
			</li>
            <?php endforeach; ?>
		</ul>
	</nav>
	<section class="lot-item container">
		<h2><?= $lot['lotname']; ?></h2>
		<div class="lot-item__content">
			<div class="lot-item__left">
				<div class="lot-item__image">
					<img src="<?= $lot['imgurl']; ?>" width="730" height="548" alt="Сноуборд">
				</div>
				<p class="lot-item__category">Категория: <span><?= htmlspecialchars($lot['name']); ?></span></p>
				<p class="lot-item__description"><?= htmlspecialchars($lot['lotdesc']); ?></p>
			</div>
			<div class="lot-item__right">
				<div class="lot-item__state">
					<div class="lot-item__timer timer <?= ($hours <= 1) ? 'timer--finishing' : ''; ?>">
						<?= htmlspecialchars($hours); ?>
					</div>
					<div class="lot-item__cost-state">
						<div class="lot-item__rate">
							<span class="lot-item__amount">Текущая цена</span>
							<span class="lot-item__cost"><?= $lot['maxprice']; ?></span>
						</div>
						<div class="lot-item__min-cost">
							Мин. ставка <span><?= htmlspecialchars($lot['bidstep'].'р'); ?></span>
						</div>
					</div>
					<form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
						<p class="lot-item__form-item form__item form__item--invalid">
							<label for="cost">Ваша ставка</label>
							<input id="cost" type="text" name="cost" placeholder="<?= htmlspecialchars($lot['bidstep']); ?>">
							<span class="form__error">Введите наименование лота</span>
						</p>
						<button type="submit" class="button">Сделать ставку</button>
					</form>
				</div>

				<div class="history">
					<h3>История ставок (<span><?= htmlspecialchars($bidscount); ?></span>)</h3>
					<table class="history__list">
                        <?php foreach ($bids as $biddata): ?>
						<tr class="history__item">
							<td class="history__name"><?= $biddata['offername']; ?></td>
							<td class="history__price"><?= $biddata['offer'].' р'; ?></td>
							<td class="history__time"><?= $biddata['bidate']; ?></td>
                            <?php endforeach; ?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</main>