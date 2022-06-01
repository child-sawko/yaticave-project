<form class="form container <?= $form ?? ""?>" action="../signup.php" method="post" enctype="multipart/form-data">

    <h2>Регистрация</h2>
    <div class="form__item <?= $error['name'] ?? ""?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите Ваше Имя" value="<?=$_POST['name'] ?? ""?>">
        <?= $message['name']  ?? ""?>
    </div>
    <div class="form__item <?= $error['contacts'] ?? ""?>">
        <label for="contacts">Номер телефона <sup>*</sup></label>
        <input id="contacts" type="text" name="contacts" placeholder="Введите номер Вашего телефона" value="<?=$_POST['contacts'] ?? ""?>">
        <?= $message['contacts']  ?? ""?>
    </div>
    <div class="form__item <?= $error['email'] ?? ""?>">
        <label for="email">Почта <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$_POST['email'] ?? ""?>">
        <?= $message['email']  ?? ""?>
    </div>
    <div class="form__item <?= $error['password'] ?? ""?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=$_POST['password'] ?? ""?>">
        <?= $message['password']  ?? ""?>
    </div>
    <div class="form__item form__item--file form__item--last <?= $error['avatar']  ?? ""?>">
        <label>Фото профиля <sup>*</sup></label>
        <div class="form__input-file">
            <input name="avatar" class="visually-hidden" type="file" id="lot-img">
            <label for="lot-img">
                Добавить
            </label>
        </div>
        <?= $message['avatar'] ?? ""?>
    </div>
    <?= $message['form'] ?? ""?>
    <button type="submit" class="button">Зарегистрироваться</button>
</form>
