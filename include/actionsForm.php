<?php
require_once '../config/config.php'; // Make sure to include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupon_code = isset($_POST["coupon_code"]) ? $_POST["coupon_code"] : "";

    // Check if the coupon code exists in the database
    $coupon_exists = false; // Assuming initially it doesn't exist

    // Query to check if the coupon code exists
    $sql = "SELECT * FROM coupons WHERE coupon_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $coupon_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Coupon exists
        $coupon_exists = true;

        // Log the action
        $user_id = 1; // Replace with the actual user ID if available
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $action_datetime = date("Y-m-d H:i:s");

        // Insert into action log table
        $sql = "INSERT INTO action_log (action_datetime, coupon_code, user_id, user_ip) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $action_datetime, $coupon_code, $user_id, $user_ip);
        $stmt->execute();
    }

    // Existing form processing code goes here
    // For example:
    
    // etc.

    // Then continue with your existing logic to handle the form submission
}
?>

<?php global $the_job, $id_type, $description, $price, $photo_path, $order_id, $errors, $method; ?>
<form action='/Project/pages/orderActions.php?method=<?= $method ?>&confirm=true
<?= (isset($_GET["id"])) ? "&id=" . $_GET["id"] : "" ?><?= (isset($_GET["menuID"])) ? "&menuID=" . $_GET["menuID"] : "" ?>' method="POST" enctype="multipart/form-data" class="container px-5 pt-4">
    <?php if ($method == "edit") : ?>
        <h2>Изменение заказа:</h2>
    <?php else : ?>
        <h2>Добавление заказа:</h2>
    <?php endif; ?>
    <div class="form-group">
        <?php if ($errors) : ?>
            <?php if ($errors == "success") : ?>
                <div class="alert alert-success" role="alert">Добавление выполнено успешно!</div>
            <?php else : ?>
                <div class="alert alert-danger" role="alert"><?= $errors ?></div>
            <?php endif; ?>
        <?php endif; ?>
        <label for="id_type">Тип работы:</label>
        <select name="id_type" class="form-select form-select-md">
            <?php $types = WorkActions::GetAllWorkTypes(); ?>
            <?php foreach ($types as $type) : ?>
                <option <?php if ($id_type == $type["id"]) echo "selected" ?> value="<?= $type["id"] ?>"><?= $type["name"] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="order_id" id="order_id" value="<?= $order_id ?>" />
        <label for="the_job">Название работ:</label>
        <input required type="text" name="the_job" id="the_job" class="form-control" value="<?= htmlspecialchars($the_job) ?>">
        <label for="description">Дополнительная информация:</label><br>
        <textarea required name="description" id="description" class="form-control"><?= htmlspecialchars($description) ?></textarea>
        <label for="price">Цена:</label>
        <input required type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($price) ?>" min="0">
        <label for="photo_path">Фото заказа:</label>
        <input <?= ($method == "edit") ? "" : "required" ?> type="file" accept=".jpg,.jpeg,.png" name="photo_path" id="photo_path" class="form-control">
        <input type="hidden" name="old_photo_path" id="old_photo_path" value="<?= htmlspecialchars($photo_path ?? "") ?>" />
        <label for="coupon_code">Код купона:</label>
        <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="<?= isset($_POST['coupon_code']) ? htmlspecialchars($_POST['coupon_code']) : '' ?>">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Принять</button>
    <a href="/Project/pages/orders.php" type="submit" class="btn btn-secondary mt-3">Вернуться</a>
</form>
