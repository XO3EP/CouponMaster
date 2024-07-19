<?php global $errors, $email, $password; ?>
<form method="POST" name="send" class="d-flex justify-content-center m-5">
    <div class="auth-form border rounded">
        <?php if (UserActions::IsAuthorized()) : ?>
            <p>Вы авторизованы как <?= $_SESSION['USER_EMAIL'] ?>&nbsp;</p>
            <a href="/Project/">← Вернуться на главную</a>
        <?php else : ?>
            <h2>Вход</h2>
            <?php if ($errors != '') : ?>
                <div class="alert alert-danger" role="alert"><?= $errors ?></div>
            <?php endif; ?>
            <input type="text" name="email" id="email" class="form-control mt-4" value="<?= htmlspecialchars($email) ?>" placeholder="Email">
            <input type="password" name="password" id="password" class="form-control mt-4" value="<?= htmlspecialchars($password) ?>" placeholder="Пароль"> <br>
            <button type="submit" class="btn btn-primary mx-4">Войти</button>
            <a href="/Project/pages/registration.php" type="submit" class="btn btn-secondary">Регистрация</a>
        <?php endif; ?>
    </div>
</form>