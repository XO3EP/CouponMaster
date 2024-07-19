<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/.core/Core.php");
$errors = UserActions::SignIn();

$email =     $_POST["email"] ?? "";
$password =  $_POST["password"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/head.php"); ?>

<body>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/header.php"); ?>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/loginForm.php"); ?>
</body>

</html>