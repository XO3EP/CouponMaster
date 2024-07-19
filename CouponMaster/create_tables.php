<?php
// Подключение к базе данных
require_once '../config/config.php';

// Запрос на создание таблиц
$sql = "
CREATE TABLE IF NOT EXISTS coupons (
    coupon_code VARCHAR(50) NOT NULL,
    coupon_type VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status VARCHAR(20) NOT NULL,
    discount_model VARCHAR(50) NOT NULL,
    PRIMARY KEY (coupon_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    report_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    report_file VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS action_log (
    action_id INT AUTO_INCREMENT PRIMARY KEY,
    action_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    coupon_code VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    user_ip VARCHAR(50) NOT NULL,
    FOREIGN KEY (coupon_code) REFERENCES coupons(coupon_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
";

if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
    // Перенаправление на страницу dashboard
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error creating tables: " . $conn->error;
}

// Закрытие соединения
$conn->close();
?>
