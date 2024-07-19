<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Project/.core/Core.php");

UserActions::SignOut();
$returnPage = $_GET["returnPage"] ?? ("/Project/index.php");
header("Location: $returnPage");
