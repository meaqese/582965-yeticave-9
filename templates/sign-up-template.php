<?php
    $form = [];

    $form['email'] = $user['email'] ?? '';
    $form['password'] = $user['password'] ?? '';
    $form['name'] = $user['name'] ?? '';
    $form['contact'] = $user['contact'] ?? '';
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
    <form class="form container <?= (isset($error)) ? 'form--invalid' : ''; ?>" action="" method="post" autocomplete="off"> <!-- form--invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?= (isset($error['email'])) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="user[email]" placeholder="Введите e-mail" value="<?= htmlspecialchars($form['email']); ?>">
            <span class="form__error">Введите ваш реальный E-Mail адрес</span>
        </div>
        <div class="form__item <?= (isset($error['password'])) ? 'form__item--invalid' : ''; ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="user[password]" placeholder="Введите пароль" value="<?= htmlspecialchars($form['password']); ?>">
            <span class="form__error">Введите пароль который не менее 8 символов</span>
        </div>
        <div class="form__item <?= (isset($error['name'])) ? 'form__item--invalid' : ''; ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="user[name]" placeholder="Введите имя" value="<?= htmlspecialchars($form['name']); ?>">
            <span class="form__error">Введите имя</span>
        </div>
        <div class="form__item <?= (isset($error['contact'])) ? 'form__item--invalid' : ''; ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="user[contact]" placeholder="Напишите как с вами связаться"><?= htmlspecialchars($form['contact']); ?></textarea>
            <span class="form__error">Напишите как с вами связаться</span>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="/login.php">Уже есть аккаунт</a>
    </form>
</main>