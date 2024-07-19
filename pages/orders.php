<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/.core/Core.php");

$description = $_POST["job"] ?? "";
$typeId = $_POST["id"] ?? "";
$minPrice = $_POST["minPrice"] ?? "";
$maxPrice = $_POST["maxPrice"] ?? "";

$data = OrderActions::GetFilter($description, $typeId, $minPrice, $maxPrice);
$work_types = WorkActions::GetAllWorkTypes();
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/head.php"); ?>

<body>
  <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/include/header.php"); ?>
  <article>
    <form method="post" class="container px-5 pt-4">
      <div class="container">
        <div class="row">
          <div class="col">
            <h4 for="job" class="form-label ">Описание</h4>
            <input name="job" type="text" id="job" class="form-control" value="<?= htmlspecialchars($description) ?>">
          </div>

          <div class="col">
            <h4 for="id" class="form-label">Тип работы</h4>
            <select id="id" name="id" class="form-select">
              <option value="">не выбрано</option>
              <?php foreach ($work_types as $type) : ?>
                <option value="<?= $type["id"] ?>" <?= $typeId == $type["id"] ? "selected" : "" ?>><?= $type["name"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col">
            <h4 for="description" class="form-label">Мин. Цена</h4>
            <input name="minPrice" type="number" id="minPrice" class="form-control" aria-describedby="passwordHelpBlock" value="<?= htmlspecialchars($minPrice) ?>">
          </div>

          <div class="col">
            <h4 for="price" class="form-label">Макс. Цена</h4>
            <input name="maxPrice" type="number" id="maxPrice" class="form-control" aria-describedby="passwordHelpBlock" value="<?= htmlspecialchars($maxPrice) ?>">
          </div>
        </div>
        <div class="col d-flex justify-content-center">
          <button type="submit" class="btn btn btn-warning mt-3 mx-2">Принять</button>
          <button type="reset" onclick="Reset()" class="btn btn btn-warning mt-3 mx-2">Отмена</button>
          <a href="/Project/pages/orderActions.php" id="table_add" class="btn btn btn-warning mt-3 mx-2">Добавить заказ</a>
        </div>
      </div>
    </form>
    <div class="container px-5 pt-4">
      <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "success") {
          echo "<div class='alert alert-success' role='alert'>Заказ успешно удален!</div>";
        } else {
          echo "<div class='alert alert-danger' role='alert'>" . $_GET["error"] . "</div>";
        }
      }
      DrawTable($data);
      ?>
    </div>
  </article>

</body>

</html>