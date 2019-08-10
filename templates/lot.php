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
		<h2><?= $lots['lotname']; ?></h2>
		<div class="lot-item__content">
			<div class="lot-item__left">
				<div class="lot-item__image">
					<img src="<?= $lots['imgurl']; ?>" width="730" height="548" alt="Сноуборд">
				</div>
				<p class="lot-item__category">Категория: <span><?= htmlspecialchars($lots['name']); ?></span></p>
				<p class="lot-item__description"><?= htmlspecialchars($lots['lotdesc']); ?></p>
			</div>
			<div class="lot-item__right">
				<div class="lot-item__state">
					<div class="lot-item__timer timer <?= ($interval['seconds'] <= 3600) ? 'timer--finishing' : ''; ?>">
						<?= $interval['hours'].':'.$interval['minutes']; ?>
					</div>
					<div class="lot-item__cost-state">
						<div class="lot-item__rate">
							<span class="lot-item__amount">Текущая цена</span>
							<span class="lot-item__cost"><?= htmlspecialchars($lots['maxprice'] + $lots['firstprice']); ?></span>
						</div>
						<div class="lot-item__min-cost">
							Мин. ставка <span><?= htmlspecialchars($lots['bidstep'].'р'); ?></span>
						</div>
					</div>
					<form class="lot-item__form" action="" method="post" autocomplete="off">
						<p class="lot-item__form-item form__item form__item--invalid">
							<label for="cost">Ваша ставка</label>
							<input id="cost" type="text" name="bet[cost]" placeholder="<?= htmlspecialchars($lots['bidstep']); ?>">
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
							<td class="history__time"><?= get_time_value($biddata['bidate']); ?></td>
                            <?php endforeach; ?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
</main>