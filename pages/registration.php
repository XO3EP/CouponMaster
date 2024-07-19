<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/.core/Core.php");
$errors = UserActions::SignUp();

$email =     $_POST["email"] ?? "";
$password =  $_POST["password"] ?? "";
$password2 = $_POST["password_2"] ?? "";
$fio =       $_POST["fio"] ?? "";
$birthday =  $_POST["birthday"] ?? "";
$address =   $_POST["address"] ?? "";
$gender =    $_POST["gender"] ?? "";
$interests = $_POST["interests"] ?? "";
$vk =        $_POST["vk"] ?? "";
$bloodType = $_POST["bloodType"] ?? "";
$rhFactor =  $_POST["rhFactor"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/head.php"); ?>

<body>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/header.php"); ?>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/registrationForm.php"); ?>
</body>

</html>