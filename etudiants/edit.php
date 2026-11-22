
<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM etudiants WHERE id_etudiant = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Étudiant introuvable.");
}

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["nom"])) {

    $sql = "UPDATE etudiants
            SET nom = :nom,
                prenom = :prenom,
                email = :email,
                telephone = :telephone,
                formation_id = :formation_id
            WHERE id_etudiant = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "email" => $_POST["email"],
        "telephone" => $_POST["telephone"],
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
    <title>Modifier un étudiant</title>
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

        <a href="index.php" class="nav-link active">
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
                GESTION <span>/</span> ÉTUDIANTS <span>/</span> MODIFICATION
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Modifier un étudiant</h1>
                <p>Mettre à jour les informations de l'étudiant.</p>
            </div>
        </section>

        <section class="content-card form-card">

            <div class="card-head">
                <div>
                    <h2>Informations de l'étudiant</h2>
                    <p>Modifiez les champs nécessaires.</p>
                </div>
            </div>

            <form method="POST">

                <div class="form-grid">

                    <div class="field">
                        <label>Nom</label>
                        <input type="text" name="nom"
                               value="<?= htmlspecialchars($etudiant['nom']) ?>"
                               required>
                    </div>

                    <div class="field">
                        <label>Prénom</label>
                        <input type="text" name="prenom"
                               value="<?= htmlspecialchars($etudiant['prenom']) ?>"
                               required>
                    </div>

                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email"
                               value="<?= htmlspecialchars($etudiant['email'] ?? '') ?>">
                    </div>

                    <div class="field">
                        <label>Téléphone</label>
                        <input type="text" name="telephone"
                               value="<?= htmlspecialchars($etudiant['telephone'] ?? '') ?>">
                    </div>

                    <div class="field">
                        <label>Formation</label>
                        <select name="formation_id" required>

                            <?php foreach ($formations as $formation) { ?>
                                <option value="<?= $formation['id_formation'] ?>"
                                    <?= $formation['id_formation'] == $etudiant['formation_id'] ? 'selected' : '' ?>>
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
