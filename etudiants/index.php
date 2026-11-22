
<?php
require_once "../database/connexion.php";

$sql = "SELECT etudiants.*, formations.libelle AS formation
        FROM etudiants
        INNER JOIN formations
        ON etudiants.formation_id = formations.id_formation";

$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
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
                GESTION <span>/</span> ÉTUDIANTS
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Liste des étudiants</h1>
                <p>Consultez et gérez les étudiants inscrits.</p>
            </div>

            <a href="create.php" class="btn btn-primary">
                + Ajouter un étudiant
            </a>
        </section>

        <section class="content-card">

            <div class="card-head">
                <div>
                    <h2>Étudiants</h2>
                    <p>Liste des étudiants enregistrés</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Formation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($etudiants as $etudiant) { ?>
                            <tr>
                                <td><?= $etudiant['id_etudiant'] ?></td>
                                <td><strong><?= htmlspecialchars($etudiant['nom']) ?></strong></td>
                                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                                <td><?= htmlspecialchars($etudiant['email'] ?? '') ?></td>
                                <td><?= htmlspecialchars($etudiant['telephone'] ?? '') ?></td>
                                <td><?= htmlspecialchars($etudiant['formation']) ?></td>
                                <td>
                                    <div class="actions">
                                        <a class="action-link" href="edit.php?id=<?= $etudiant['id_etudiant'] ?>">
                                            Modifier
                                        </a>
                                        <a class="action-link delete"
                                           href="delete.php?id=<?= $etudiant['id_etudiant'] ?>"
                                           onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if (empty($etudiants)) { ?>
                            <tr>
                                <td colspan="7" class="empty">
                                    Aucun étudiant enregistré.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </section>

    </main>
</div>

</body>
</html>
