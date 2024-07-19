<?php
// Подключение к базе данных
require_once '../config/config.php';

// Запрос на получение данных из таблицы "Журнал действий"
$sql = "SELECT * FROM action_log";
$result = $conn->query($sql);

// Получение количества использованных купонов за текущий месяц
$current_month_coupons_sql = "SELECT COUNT(*) AS month_coupons FROM action_log WHERE MONTH(action_datetime) = MONTH(CURRENT_DATE())";
$current_month_coupons_result = $conn->query($current_month_coupons_sql);
$current_month_coupons_row = $current_month_coupons_result->fetch_assoc();
$current_month_coupons = $current_month_coupons_row['month_coupons'];

// Получение количества использованных купонов за текущий год
$current_year_coupons_sql = "SELECT COUNT(*) AS year_coupons FROM action_log WHERE YEAR(action_datetime) = YEAR(CURRENT_DATE())";
$current_year_coupons_result = $conn->query($current_year_coupons_sql);
$current_year_coupons_row = $current_year_coupons_result->fetch_assoc();
$current_year_coupons = $current_year_coupons_row['year_coupons'];

// Получение информации о самом популярном купоне
$popular_coupon_sql = "SELECT coupon_code, COUNT(*) AS usage_count FROM action_log GROUP BY coupon_code ORDER BY usage_count DESC LIMIT 1";
$popular_coupon_result = $conn->query($popular_coupon_sql);
$popular_coupon_row = $popular_coupon_result->fetch_assoc();
$popular_coupon_code = $popular_coupon_row['coupon_code'];
$popular_coupon_usage_count = $popular_coupon_row['usage_count'];

// Вычисление коэффициента вовлеченности клиентов
$total_customers_sql = "SELECT COUNT(DISTINCT user_id) AS total_customers FROM action_log";
$total_customers_result = $conn->query($total_customers_sql);
$total_customers_row = $total_customers_result->fetch_assoc();
$total_customers = $total_customers_row['total_customers'];

$total_coupon_users_sql = "SELECT COUNT(DISTINCT user_id) AS total_coupon_users FROM action_log WHERE coupon_code IS NOT NULL";
$total_coupon_users_result = $conn->query($total_coupon_users_sql);
$total_coupon_users_row = $total_coupon_users_result->fetch_assoc();
$total_coupon_users = $total_coupon_users_row['total_coupon_users'];

$engagement_ratio = $total_coupon_users / $total_customers;

// Создание содержимого для текстового отчета
$report_content = "Отчет о действиях:\n";
$report_content .= "Количество использованных купонов за текущий месяц: $current_month_coupons\n";
$report_content .= "Количество использованных купонов за текущий год: $current_year_coupons\n";
$report_content .= "Самый популярный купон: $popular_coupon_code (Количество использований: $popular_coupon_usage_count)\n";
$report_content .= "Коэффициент вовлеченности клиентов: $engagement_ratio\n";

// Создание текстового файла с отчетом
$txt_file_path = "reports/action_log_report_" . date("Y-m-d_H-i-s") . ".txt";
file_put_contents($txt_file_path, $report_content);

// Добавление записи о созданном отчете в таблицу "reports"
$insert_sql = "INSERT INTO reports (report_datetime, report_file) VALUES (NOW(), ?)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("s", $txt_file_path);
$stmt->execute();
$stmt->close();



// Закрытие соединения
$conn->close();

// Перенаправление на главную страницу
header("Location: dashboard.php");
exit();
?>
