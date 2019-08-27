<?php
    $form = [];

    $form['email'] = $authdata['email'] ?? '';
    $form['password'] = $authdata['password'] ?? '';
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
    <form class="form container <?= (isset($error)) ? 'form--invalid' : ''; ?>" action="" method="post"> <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?= (isset($error['email'])) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="authdata[email]" placeholder="Введите e-mail" value="<?= $form['email']; ?>">
            <span class="form__error"><?= (isset($error['email'])) ? $error['email'] : ''; ?></span>
        </div>
        <div class="form__item form__item--last <?= (isset($error['password'])) ? 'form__item--invalid' : ''; ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="authdata[password]" placeholder="Введите пароль" value="<?= $form['password']; ?>">
            <span class="form__error"><?= (isset($error['password'])) ? $error['password'] : ''; ?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>