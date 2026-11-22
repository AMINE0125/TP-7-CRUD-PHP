
<?php

require_once "../database/connexion.php";

$sql = "SELECT * FROM formations";
$statement = $pdo->query($sql);
$formations = $statement->fetchAll(PDO::FETCH_ASSOC);

if (
    isset($_POST["nom"])
    && isset($_POST["prenom"])
    && isset($_POST["formation_id"])
) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $formation_id = $_POST["formation_id"];

    $sql = "INSERT INTO etudiants (nom, prenom, email, telephone, formation_id)
            VALUES (:nom, :prenom, :email, :telephone, :formation_id)";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "telephone" => $telephone,
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
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
                GESTION <span>/</span> ÉTUDIANTS <span>/</span> AJOUT
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Ajouter un étudiant</h1>
                <p>Remplissez les informations du nouvel étudiant.</p>
            </div>
        </section>

        <section class="content-card form-card">

            <form method="POST">

                <div class="form-grid">

                    <div class="field">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>

                    <div class="field">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>

                    <div class="field">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="field">
                        <label for="telephone">Téléphone :</label>
                        <input type="text" id="telephone" name="telephone">
                    </div>

                    <div class="field full">
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

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="index.php" class="btn btn-ghost">Retour</a>
                </div>

            </form>

        </section>

    </main>
</div>

</body>
</html>
