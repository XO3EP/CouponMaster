<?php
// Подключение к базе данных
require_once '../config/config.php';

// Проверяем, был ли передан код купона для удаления
if(isset($_GET['coupon_code'])) {
    $coupon_code = $_GET['coupon_code'];

    // Проверяем, есть ли записи в таблице action_log, связанные с этим купоном
    $check_sql = "SELECT * FROM action_log WHERE coupon_code = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("s", $coupon_code);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $num_rows = $result_check->num_rows;

    // Если есть связанные записи в таблице action_log, удаляем их
    if($num_rows > 0) {
        $delete_sql = "DELETE FROM action_log WHERE coupon_code = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param("s", $coupon_code);
        $stmt_delete->execute();
    }

    // Подготовленный запрос для удаления купона по его коду
    $delete_sql = "DELETE FROM coupons WHERE coupon_code = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $coupon_code);
    
    // Выполняем запрос
    if($stmt->execute()) {
        // Успешно удален
        echo "<script>alert('Купон успешно удален');window.location.href='dashboard.php';</script>";
    } else {
        // Произошла ошибка при удалении
        echo "<script>alert('Произошла ошибка при удалении купона');window.location.href='dashboard.php';</script>";
    }
} else {
    // Если код купона не был передан, перенаправляем пользователя обратно на страницу дашборда
    header("Location: dashboard.php");
    exit();
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
