<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/.core/Core.php");

$method = (isset($_GET["method"])) ? $_GET["method"] : "";
$confirm = (isset($_GET["confirm"])) ? $_GET["confirm"] : "";

switch ($method) {
    case "edit":
        if ($confirm == "false") {
            $order_id = $_GET["order_id"] ?? "";
            $order = OrderActions::GetOrderByID($order_id);
            $the_job = $order["the_job"] ?? "";
            $id_type = $order["id_type"] ?? "";
            $description = $order["description"] ?? "";
            $price = $order["price"] ?? "";
            $photo_path = $order["photo_path"] ?? "";
        } elseif ($confirm == "true") {
            $errors = OrderActions::Update();
            $the_job = $_POST["the_job"] ?? "";
            $id_type = $_POST["id_type"] ?? "";
            $description = $_POST["description"] ?? "";
            $price = $_POST["price"] ?? "";
            $photo_path = $_POST["photo_path"] ?? "";
            $order_id = $_POST["order_id"] ?? "";
        }
        break;
    case "delete":
            $errors = OrderActions::Delete();
            header("Location: /Project/pages/orders.php?error=" . $errors);
        break;
    default:
        $errors = OrderActions::Add();
        $the_job = $_POST["the_job"] ?? "";
        $id_type = $_POST["id_type"] ?? "";
        $description = $_POST["description"] ?? "";
        $price = $_POST["price"] ?? "";
        $photo_path = "";
        
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/head.php"); ?>

<body>
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/header.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/actionsForm.php");
    ?>
</body>

</html>