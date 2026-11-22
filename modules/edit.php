
<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM modules WHERE id_module = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    die("Module introuvable.");
}

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["nom"])) {

    $sql = "UPDATE modules
            SET nom = :nom,
                coefficient = :coefficient,
                volume_horaire = :volume_horaire,
                formation_id = :formation_id
            WHERE id_module = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "nom" => $_POST["nom"],
        "coefficient" => $_POST["coefficient"] !== "" ? $_POST["coefficient"] : null,
        "volume_horaire" => $_POST["volume_horaire"] !== "" ? $_POST["volume_horaire"] : null,
        "formation_id" => $_POST["formation_id"],
        "id" => $id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un module</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>

<div class="app-shell">

    <aside class="sidebar">
        <div class="brand">
            <span class="brand-mark">C</span>
            <span>
                <strong>Centre</strong>
                <small>FORMATION</small>
            </span>
        </div>

        <span class="nav-label">MENU PRINCIPAL</span>

        <a href="../index.php" class="nav-link">
            <span>⌂</span> Accueil
        </a>

        <a href="../formations/index.php" class="nav-link">
            <span>▤</span> Formations
        </a>

        <a href="../etudiants/index.php" class="nav-link">
            <span>♙</span> Étudiants
        </a>

        <a href="index.php" class="nav-link active">
            <span>▦</span> Modules
        </a>

        <div class="sidebar-footer">
            <div class="avatar">CF</div>
            <div>
                <strong>Administration</strong>
                <small>Gestion du centre</small>
            </div>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div class="breadcrumb">
                GESTION <span>/</span> MODULES <span>/</span> MODIFICATION
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Modifier un module</h1>
                <p>Mettre à jour les informations du module.</p>
            </div>
        </section>

        <section class="content-card form-card">

            <div class="card-head">
                <div>
                    <h2>Informations du module</h2>
                    <p>Modifiez les champs nécessaires.</p>
                </div>
            </div>

            <form method="POST">

                <div class="form-grid">

                    <div class="field">
                        <label>Nom du module</label>
                        <input type="text" name="nom"
                               value="<?= htmlspecialchars($module['nom']) ?>"
                               required>
                    </div>

                    <div class="field">
                        <label>Coefficient</label>
                        <input type="number" name="coefficient"
                               value="<?= htmlspecialchars($module['coefficient'] ?? '') ?>">
                    </div>

                    <div class="field">
                        <label>Volume horaire</label>
                        <input type="number" name="volume_horaire"
                               value="<?= htmlspecialchars($module['volume_horaire'] ?? '') ?>">
                    </div>

                    <div class="field">
                        <label>Formation</label>
                        <select name="formation_id" required>

                            <?php foreach ($formations as $formation) { ?>
                                <option value="<?= $formation['id_formation'] ?>"
                                    <?= $formation['id_formation'] == $module['formation_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($formation['libelle']) ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        Modifier
                    </button>

                    <a href="index.php" class="btn btn-ghost">
                        Retour
                    </a>
                </div>

            </form>

        </section>

    </main>

</div>

</body>
</html>
