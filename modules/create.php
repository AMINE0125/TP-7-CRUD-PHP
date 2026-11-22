
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../database/connexion.php";

$sql = "SELECT * FROM formations";
$statement = $pdo->query($sql);
$formations = $statement->fetchAll(PDO::FETCH_ASSOC);

if (
    isset($_POST["nom"])
    && isset($_POST["formation_id"])
) {

    $nom = $_POST["nom"];
    $coefficient = $_POST["coefficient"];
    $volume_horaire = $_POST["volume_horaire"];
    $formation_id = $_POST["formation_id"];

    $sql = "INSERT INTO modules (nom, coefficient, volume_horaire, formation_id)
            VALUES (:nom, :coefficient, :volume_horaire, :formation_id)";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "nom" => $nom,
        "coefficient" => $coefficient,
        "volume_horaire" => $volume_horaire,
        "formation_id" => $formation_id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
</head>
<body>

    <h1>Ajouter un module</h1>

    <form method="POST">

        <div>
            <label for="nom">Nom du module :</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <br>

        <div>
            <label for="coefficient">Coefficient :</label>
            <input type="number" id="coefficient" name="coefficient">
        </div>

        <br>

        <div>
            <label for="volume_horaire">Volume horaire :</label>
            <input type="number" id="volume_horaire" name="volume_horaire">
        </div>

        <br>

        <div>
            <label for="formation_id">Formation :</label>

            <select id="formation_id" name="formation_id" required>
                <option value="">Choisir une formation</option>

                <?php foreach ($formations as $formation) { ?>
                    <option value="<?= $formation['id_formation'] ?>">
                        <?= htmlspecialchars($formation['libelle']) ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <br>

        <button type="submit">Ajouter</button>

    </form>

    <br>

    <a href="index.php">Retour</a>

</body>
</html>
