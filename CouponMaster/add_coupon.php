<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon</title>
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
        <h1>Добавить купон</h1>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Назад</a> <!-- Кнопка "Назад" -->
        <?php
        // Подключение к базе данных
        require_once('../config/config.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Получение данных из формы
            $coupon_code = $_POST['coupon_code'];
            $coupon_type = $_POST['coupon_type'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = $_POST['status'];
            $discount_model = $_POST['discount_model'];

            // Запрос для проверки наличия купона с указанным кодом
            $check_sql = "SELECT coupon_code FROM coupons WHERE coupon_code = '$coupon_code'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo "<div class='alert alert-danger' role='alert'>Такой купон уже существует.</div>";
            } else {
                // Запрос для добавления купона в базу данных
                $insert_sql = "INSERT INTO coupons (coupon_code, coupon_type, start_date, end_date, status, discount_model) 
                        VALUES ('$coupon_code', '$coupon_type', '$start_date', '$end_date', '$status', '$discount_model')";

                if ($conn->query($insert_sql) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Coupon added successfully</div>";
                    // Перенаправление на страницу dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
                }
            }
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="coupon_code">Код купона:</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
            </div>
            <div class="form-group">
                <label for="coupon_type">Тип купона:</label>
                <select class="form-control" id="coupon_type" name="coupon_type" required>
                    <option value="Percentage">Процентный</option>
                    <option value="Fixed Amount">Фиксированная сумма</option>
                    <!-- Другие типы купонов, если есть -->
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Дата начала:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Дата окончания:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="status">Статус:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active">Активен</option>
                    <option value="Inactive">Неактивен</option>
                    <!-- Другие статусы, если есть -->
                </select>
            </div>
            <div class="form-group">
                <label for="discount_model">Скидочная модель:</label>
                <input type="text" class="form-control" id="discount_model" name="discount_model" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
    <!-- Подключение JS Bootstrap (необходимо для некоторых функций) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
