
<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "DELETE FROM formations WHERE id_formation = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

header("Location: index.php");
exit;

?>
