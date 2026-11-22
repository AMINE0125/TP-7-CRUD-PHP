
<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM formations WHERE id_formation = :id";
$statement = $pdo->prepare($sql);
$statement->execute(["id" => $id]);

$formation = $statement->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    die("Formation introuvable.");
}

if (isset($_POST["libelle"])) {

    $libelle = $_POST["libelle"];
    $description = $_POST["description"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];

    $sql = "UPDATE formations
            SET libelle = :libelle,
                description = :description,
                date_debut = :date_debut,
                date_fin = :date_fin
            WHERE id_formation = :id";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "libelle" => $libelle,
        "description" => $description,
        "date_debut" => $date_debut,
        "date_fin" => $date_fin,
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
    <title>Modifier une formation</title>
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

        <a href="index.php" class="nav-link active">
            <span>▤</span> Formations
        </a>

        <a href="../etudiants/index.php" class="nav-link">
            <span>♙</span> Étudiants
        </a>

        <a href="../modules/index.php" class="nav-link">
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
                GESTION <span>/</span> FORMATIONS <span>/</span> MODIFICATION
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Modifier une formation</h1>
                <p>Modifiez les informations de cette formation.</p>
            </div>
        </section>

        <section class="content-card form-card">

            <form method="POST">

                <div class="form-grid">

                    <div class="field full">
                        <label for="libelle">Libellé :</label>
                        <input
                            type="text"
                            id="libelle"
                            name="libelle"
                            value="<?= htmlspecialchars($formation['libelle']) ?>"
                            required
                        >
                    </div>

                    <div class="field full">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($formation['description'] ?? '') ?></textarea>
                    </div>

                    <div class="field">
                        <label for="date_debut">Date début :</label>
                        <input
                            type="date"
                            id="date_debut"
                            name="date_debut"
                            value="<?= htmlspecialchars($formation['date_debut'] ?? '') ?>"
                        >
                    </div>

                    <div class="field">
                        <label for="date_fin">Date fin :</label>
                        <input
                            type="date"
                            id="date_fin"
                            name="date_fin"
                            value="<?= htmlspecialchars($formation['date_fin'] ?? '') ?>"
                        >
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="index.php" class="btn btn-ghost">Retour</a>
                </div>

            </form>

        </section>

    </main>
</div>

</body>
</html>
