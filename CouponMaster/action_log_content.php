<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Содержимое таблицы "Журнал действий"</title>
    <!-- Подключение CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Фиксированная шапка таблицы */
        .fixed-header thead {
            position: sticky;
            top: 0;
            background-color: #fff; /* Фоновый цвет шапки */
            z-index: 1000; /* Устанавливаем z-index, чтобы шапка была выше других элементов */
        }

        /* Задаем высоту таблицы и добавляем отступ */
        .table-container {
            max-height: calc(100vh - 200px); 
            overflow-y: auto; /* Добавление вертикальной прокрутки */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Содержимое таблицы "Журнал действий"</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Назад</a> <!-- Кнопка "Назад" -->
        <!-- Ваш PHP код для отображения содержимого таблицы "Журнал действий" -->
        <?php
        // Подключение к базе данных
        require_once dirname(__DIR__) . '/config/config.php';

        // Запрос на получение данных из таблицы "Журнал действий"
        $sql = "SELECT * FROM action_log";
        $result = $conn->query($sql);

        // Проверка наличия результатов
        if ($result->num_rows > 0) {
            echo '<div class="table-container">';
            echo '<table class="table table-bordered fixed-header">';
            echo '<thead class="thead-dark"><tr><th>ID Действия</th><th>Дата и Время</th><th>Код Купона</th><th>ID Пользователя</th><th>IP Пользователя</th></tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["action_id"]."</td>";
                echo "<td>".$row["action_datetime"]."</td>";
                echo "<td>".$row["coupon_code"]."</td>";
                echo "<td>".$row["user_id"]."</td>";
                echo "<td>".$row["user_ip"]."</td>";
                echo "</tr>";
            }
            echo '</tbody></table>';
            echo '</div>';
        } else {
            echo "<p>Нет данных в таблице</p>";
        }
        ?>
    </div>

    <!-- Подключение JS Bootstrap (необходимо для некоторых функций) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
