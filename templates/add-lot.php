<?php
    $form = [];

    $form['name'] = $lot['name'] ?? '';
    $form['category'] = $lot['category'] ?? '';
    $form['description'] = $lot['description'] ?? '';
    $form['firstprice'] = $lot['firstprice'] ?? '';
    $form['bidstep'] = $lot['bidstep'] ?? '';
    $form['enddate'] = $lot['enddate'] ?? '';
?>
<main>
	<nav class="nav">
		<ul class="nav__list container">
			<?php foreach ($categories as $category): ?>
			<li class="nav__item">
				<a href="all-lots.html"><?= $category['name']; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<form class="form form--add-lot container <?= (isset($error)) ? 'form--invalid' : '';?>" action="" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
		<h2>Добавление лота</h2>
		<div class="form__container-two">
			<div class="form__item <?= (isset($error['name'])) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
				<label for="lot-name">Наименование <sup>*</sup></label>
				<input id="lot-name" type="text" name="lot[name]" value="<?= strip_tags($form['name']); ?>" placeholder="Введите наименование лота">
				<span class="form__error">Введите наименование лота</span>
			</div>
			<div class="form__item <?= (isset($error['category'])) ? 'form__item--invalid' : ''; ?>">
				<label for="category">Категория <sup>*</sup></label>
				<select id="category" name="lot[category]">
					<option value="0">Выберите категорию</option>
                    <?php foreach ($categories as $category) : ?>
					<option value="<?= $category['id'] ?>"<?= ($category['id'] == strip_tags($form['category'])) ? 'selected' : ''; ?> ><?= $category['name']; ?></option>
                    <?php endforeach; ?>
				</select>
				<span class="form__error"><?= $error['category']; ?></span>
			</div>
		</div>
		<div class="form__item form__item--wide <?= (isset($error['description'])) ? 'form__item--invalid' : ''; ?>">
			<label for="message">Описание <sup>*</sup></label>
			<textarea id="message" name="lot[description]" placeholder="Напишите описание лота"><?= strip_tags($form['description']); ?></textarea>
			<span class="form__error">Напишите описание лота</span>
		</div>
		<div class="form__item form__item--file <?= (isset($error['file'])) ? 'form__item--invalid' : ''; ?>">
			<label>Изображение <sup>*</sup></label>
			<div class="form__input-file">
				<input class="visually-hidden" type="file" name="lot-img" id="lot-img" value="">
				<label for="lot-img">Добавить</label>
                <span class="form__error"><?= $error['file']; ?></span>
			</div>
		</div>
		<div class="form__container-three">
			<div class="form__item form__item--small <?= (isset($error['firstprice'])) ? 'form__item--invalid' : ''; ?>">
				<label for="lot-rate">Начальная цена <sup>*</sup></label>
				<input id="lot-rate" type="text" name="lot[firstprice]" value="<?= strip_tags($form['firstprice']); ?>" placeholder="0">
				<span class="form__error"><?= $error['firstprice']; ?></span>
			</div>
			<div class="form__item form__item--small <?= (isset($error['bidstep'])) ? 'form__item--invalid' : ''; ?>">
				<label for="lot-step">Шаг ставки <sup>*</sup></label>
				<input id="lot-step" type="text" name="lot[bidstep]" value="<?= strip_tags($form['bidstep']); ?>" placeholder="0">
				<span class="form__error"><?= $error['bidstep']; ?></span>
			</div>
			<div class="form__item <?= (isset($error['enddate'])) ? 'form__item--invalid' : ''; ?>">
				<label for="lot-date">Дата окончания торгов <sup>*</sup></label>
				<input class="form__input-date" id="lot-date" type="text" name="lot[enddate]" value="<?= strip_tags($form['enddate']); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
				<span class="form__error"><?= $error['enddate']; ?></span>
			</div>
		</div>
		<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
		<button type="submit" class="button">Добавить лот</button>
	</form>
</main>

