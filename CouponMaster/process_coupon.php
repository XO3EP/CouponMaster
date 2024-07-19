<?php
// Подключение к базе данных
require_once('../config/config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$coupon_code = $_POST['coupon_code'];
$coupon_type = $_POST['coupon_type'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$status = $_POST['status'];
$discount_model = $_POST['discount_model'];

$check_sql = "SELECT * FROM coupons WHERE coupon_code = '$coupon_code'";
$result = $conn->query($check_sql);
if ($result->num_rows > 0) {
    // Если купон уже существует, выводим сообщение об ошибке
    echo "Error: Coupon with the same code already exists!";
} else {
    $sql = "INSERT INTO coupons (coupon_code, coupon_type, start_date, end_date, status, discount_model) 
        VALUES ('$coupon_code', '$coupon_type', '$start_date', '$end_date', '$status', '$discount_model')";

if ($conn->query($sql) === TRUE) {
    echo "Coupon added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: dashboard.php");
exit();
}
// Запрос для добавления купона в базу данных

?>
