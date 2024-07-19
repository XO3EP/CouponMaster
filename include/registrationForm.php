<?php global $errors, $email, $password, $password2, $fio, $birthday, $address, $gender, $interests, $vk, $bloodType, $rhFactor; ?>
<form method="POST" name="send" class="d-flex justify-content-center m-5">
    <div class="auth-form border rounded">
        <?php if (UserActions::IsAuthorized()) : ?>
            <p>Вы авторизованы как <?= $_SESSION['USER_EMAIL'] ?>&nbsp;</p>
            <a href="/Project/">← Вернуться на главную</a>
        <?php else : ?>
            <h2>Регистрация</h2><br>
            <?php if ($errors != '') : ?>
                <div class="alert alert-danger" role="alert"><?= $errors ?></div>
            <?php endif; ?>
            <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" placeholder="Email"><br>
            <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($password) ?>" placeholder="Пароль"> <br>
            <input type="password" name="password_2" class="form-control" value="<?= htmlspecialchars($password2) ?>" placeholder="Повторите пароль"> <br>
            <input type="text" name="fio" class="form-control" value="<?= htmlspecialchars($fio) ?>" placeholder="ФИО"> <br>
            <input type="date" name="birthday" class="form-control" value="<?= htmlspecialchars($birthday) ?>"> <br>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($address) ?>" placeholder="Адрес"> <br>
            <select class="form-select" name="gender">
                <option <?php if ($gender == "male") echo "selected" ?> value="male">Мужской</option>
                <option <?php if ($gender == "female") echo "selected" ?> value="female">Женский</option>
            </select><br>
            <textarea name="interests" class="form-control" placeholder="Интересы"><?= htmlspecialchars($interests) ?></textarea> <br>
            <input type="text" name="vk" class="form-control" value="<?= htmlspecialchars($vk) ?>" placeholder="Ссылка на ВК"> <br>
            <input type="text" name="bloodType" class="form-control" value="<?= htmlspecialchars($bloodType) ?>" placeholder="Группа крови"> <br>
            <input type="text" name="rhFactor" class="form-control" value="<?= htmlspecialchars($rhFactor) ?>" placeholder="Резус-фактор"> <br>
            <button type="submit" class="btn btn-primary reg mx-2">Зарегистрироваться</button>
            <a href="/Project/pages/login.php" type="submit" class="btn btn-secondary">Вход</a>
        <?php endif; ?>
    </div>
</form>