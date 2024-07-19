<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coupon</title>
    <!-- Подключение CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактировать купон</h1>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Назад</a> <!-- Кнопка "Назад" -->
        <?php
        // Подключение к базе данных
        require_once('../config/config.php');

        // Проверяем, передан ли параметр coupon_code через GET запрос
        if (isset($_GET['coupon_code'])) {
            $coupon_code = $_GET['coupon_code'];

            // Запрос для получения данных о купоне
            $sql = "SELECT * FROM coupons WHERE coupon_code='$coupon_code'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // Получение данных о купоне
                $row = $result->fetch_assoc();
                $coupon_code = $row['coupon_code'];
                $coupon_type = $row['coupon_type'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $status = $row['status'];
                $discount_model = $row['discount_model'];
            } else {
                // Если купон с указанным кодом не найден, выводим сообщение об ошибке
                echo "<div class='alert alert-danger' role='alert'>Купон с указанным кодом не найден.</div>";
                exit();
            }
        } else {
            // Если параметр coupon_code не передан, выводим сообщение об ошибке
            echo "<div class='alert alert-danger' role='alert'>Не передан параметр coupon_code.</div>";
            exit();
        }

        // Обработка формы после отправки
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Получение данных из формы
            $new_coupon_code = $_POST['coupon_code'];
            $new_coupon_type = $_POST['coupon_type'];
            $new_start_date = $_POST['start_date'];
            $new_end_date = $_POST['end_date'];
            $new_status = $_POST['status'];
            $new_discount_model = $_POST['discount_model'];

            // Запрос для обновления данных о купоне
            $update_sql = "UPDATE coupons SET coupon_code='$new_coupon_code', coupon_type='$new_coupon_type', start_date='$new_start_date', end_date='$new_end_date', status='$new_status', discount_model='$new_discount_model' WHERE coupon_code='$coupon_code'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Купон успешно изменен.</div>";
                // Перенаправление на страницу dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Ошибка при изменении купона: " . $conn->error . "</div>";
            }
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?coupon_code=" . $coupon_code; ?>" method="post">
            <div class="form-group">
                <label for="coupon_code">Код купона:</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="<?php echo $coupon_code; ?>" required>
            </div>
            <div class="form-group">
                <label for="coupon_type">Тип купона:</label>
                <select class="form-control" id="coupon_type" name="coupon_type" required>
                    <option value="Percentage" <?php if ($coupon_type == 'Percentage') echo 'selected'; ?>>Процентный</option>
                    <option value="Fixed Amount" <?php if ($coupon_type == 'Fixed Amount') echo 'selected'; ?>>Фиксированная сумма</option>
                    <!-- Другие типы купонов, если есть -->
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Дата начала:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>" required>
            </div>
            <div class="form-group">
                <label for="end_date">Дата окончания:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Статус:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active" <?php if ($status == 'Active') echo 'selected'; ?>>Активен</option>
                    <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'; ?>>Неактивен</option>
                    <!-- Другие статусы, если есть -->
                </select>
            </div>
            <div class="form-group">
                <label for="discount_model">Скидочная модель:</label>
                <input type="text" class="form-control" id="discount_model" name="discount_model" value="<?php echo $discount_model; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Принять</button>
        </form>
    </div>
    <!-- Подключение JS Bootstrap (необходимо для некоторых функций) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
