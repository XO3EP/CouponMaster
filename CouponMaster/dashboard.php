<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дашборд</title>
    <!-- Подключение CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS для ограничения таблицы и зафиксированной шапки */
        .table-container {
            max-height: 400px; /* Установите желаемую максимальную высоту */
            overflow-y: auto; /* Добавление вертикальной прокрутки */
        }

        /* Зафиксированная шапка таблицы */
        .sticky-header thead {
            position: sticky;
            top: 0;
            background-color: #fff; /* Фоновый цвет шапки */
            z-index: 1000; /* Устанавливаем z-index, чтобы шапка была выше других элементов */
        }

        /* Стили для ссылки */
        a.custom-link {
            color: black; /* Черный цвет текста */
            text-decoration: underline; /* Подчеркивание */
            transition: color 0.3s; /* Плавное изменение цвета текста при наведении */
        }

        /* Стили для ссылки при наведении */
        a.custom-link:hover {
            color: #6c757d; /* Серый цвет текста */
        }
        .table-container {
            max-height: calc(100vh*0.36); 
            overflow-y: auto; /* Добавление вертикальной прокрутки */
        }
        .main-container {
        background-color: #f8f9fa; /* Цвет фона */
        padding: 20px; /* Внутренний отступ */
        margin: 20px auto; /* Внешний отступ по краям и автоматическое центрирование */
        border-radius: 10px; /* Закругленные углы */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Тень */
    }

    </style>
</head>
<body>
    <div class="container main-container">
        <!-- Заголовок и кнопка создания таблиц -->
        <?php
        // Подключение к базе данных
        require_once 'B:\xampp\htdocs\Project\config\config.php';

        // Проверяем наличие таблиц в базе данных
        $tables_exist = true;
        $tables = array('coupons', 'action_log', 'reports');
        foreach ($tables as $table) {
            $check_table_sql = "SHOW TABLES LIKE '$table'";
            $check_table_result = $conn->query($check_table_sql);
            if ($check_table_result->num_rows == 0) {
                $tables_exist = false;
                break;
            }
        }

        if ($tables_exist) {
            // Если таблицы существуют, отображаем содержимое dashboard
            ?>
            <h2>Купоны</h2>
            <div class="table-container">
                <!-- Таблица с купонами -->
                <table class="table table-bordered sticky-header">
                    <thead class="thead-dark">
                        <tr>
                            <th>Код купона</th>
                            <th>Тип купона</th>
                            <th>Дата начала</th>
                            <th>Дата окончания</th>
                            <th>Статус</th>
                            <th>Модель скидки</th>
                            <th></th> <!-- Добавлен заголовок для столбца с кнопками действий -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Запрос на получение данных из таблицы "Купоны"
                        $sql = "SELECT * FROM coupons";
                        $result = $conn->query($sql);
                        // Проверка наличия результатов
                        if ($result->num_rows > 0) {
                            // Вывод данных каждой строки
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="table-container">';
                                echo "<tr>";
                                echo "<td>".$row["coupon_code"]."</td>";
                                echo "<td>".$row["coupon_type"]."</td>";
                                echo "<td>".$row["start_date"]."</td>";
                                echo "<td>".$row["end_date"]."</td>";
                                echo "<td>".$row["status"]."</td>";
                                echo "<td>".$row["discount_model"]."</td>";
                                
                                // Добавление кнопок для удаления и изменения купонов
                                echo "<td class='text-center'>";
                                echo "<div class='d-inline-block'>";
                                echo "<button onclick=\"location.href='delete_coupon.php?coupon_code=".$row['coupon_code']."'\" class=\"btn btn-danger mr-2\">Удалить</button>";
                                echo "<button onclick=\"location.href='edit_coupon.php?coupon_code=".$row['coupon_code']."'\" class=\"btn btn-warning\">Изменить</button>";
                                echo "</div>";
                                echo "</td>";
                                
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Нет данных в таблице</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button onclick="location.href='add_coupon.php'" class="btn btn-success mt-3 mb-3">Добавить купон</button>
            <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Левая часть: основная информация -->
                <h2>Отчет</h2>
                <!-- Отчет с краткой информацией -->
            <div class="container">
    <?php
    // Подключение к базе данных
    require_once '../config/config.php';

    // Запрос на получение последнего отчета
    $last_report_sql = "SELECT * FROM reports ORDER BY report_datetime DESC LIMIT 1";
    $last_report_result = $conn->query($last_report_sql);

    // Проверка наличия последнего отчета
    if ($last_report_result->num_rows > 0) {
        $last_report_row = $last_report_result->fetch_assoc();
        $last_report_file = $last_report_row['report_file'];
        $last_report_content = file_get_contents($last_report_file);
        // Вывод содержимого последнего отчета
        echo "<pre>";
        echo htmlspecialchars($last_report_content);
        echo "</pre>";
    } else {
        // Если отчетов нет
        echo "<p>Отчетов не найдено</p>";
    }
    ?>
</div>

                <form action="generate_report.php" method="post">
                    <input type="submit" value="Создать отчет" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-6">
                <!-- Правая часть: таблица журнала действий -->
                <h2><a href="action_log_content.php">Журнал действий</a></h2>
                <div class="table-container">
                    <!-- Таблица журнала действий -->
                    <table class="table table-bordered sticky-header">
                        <thead class="thead-dark">
                            <tr>
                                <th>Код купона</th>
                                <th>Дата и время действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Подключение к базе данных
                            require_once '../config/config.php';

                            // Запрос на получение данных из таблицы "Журнал действий"
                            $sql = "SELECT coupon_code, action_datetime FROM action_log";
                            $result = $conn->query($sql);

                            // Проверка наличия результатов
                            if ($result->num_rows > 0) {
                                // Вывод данных каждой строки
                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="table-container">';
                                    echo "<tr>";
                                    echo "<td>".$row["coupon_code"]."</td>";
                                    echo "<td>".$row["action_datetime"]."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>Нет данных в таблице</td></tr>";
                            }
                            // Закрытие соединения
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
            <?php
        } else {
            // Если таблицы не существуют, отображаем кнопку для создания таблиц
            ?>
            <h2>Создание таблиц</h2>
            <form action="create_tables.php" method="post">
                <input type="submit" value="Создать таблицы" class="btn btn-primary">
            </form>
            <?php
        }
        // Закрытие соединения
        $conn->close();
        ?>
    </div>

    <!-- Подключение JS Bootstrap (необходимо для некоторых функций) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
