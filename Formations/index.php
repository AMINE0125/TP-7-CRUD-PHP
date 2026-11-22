
<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des formations</title>

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
                GESTION <span>/</span> FORMATIONS
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Liste des formations</h1>
                <p>Consultez et gérez les formations disponibles.</p>
            </div>

            <a href="create.php" class="btn btn-primary">
                + Ajouter une formation
            </a>
        </section>

        <section class="content-card">

            <div class="card-head">
                <div>
                    <h2>Formations</h2>
                    <p>Liste des formations enregistrées</p>
                </div>
            </div>

            <div class="table-wrap">

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libellé</th>
                            <th>Description</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($formations as $formation) { ?>
                            <tr>
                                <td><?= $formation['id_formation'] ?></td>

                                <td>
                                    <strong><?= htmlspecialchars($formation['libelle']) ?></strong>
                                </td>

                                <td><?= htmlspecialchars($formation['description'] ?? '') ?></td>
                                <td><?= htmlspecialchars($formation['date_debut'] ?? '') ?></td>
                                <td><?= htmlspecialchars($formation['date_fin'] ?? '') ?></td>

                                <td>
                                    <div class="actions">
                                        <a class="action-link"
                                           href="edit.php?id=<?= $formation['id_formation'] ?>">
                                            Modifier
                                        </a>

                                        <a class="action-link delete"
                                           href="delete.php?id=<?= $formation['id_formation'] ?>"
                                           onclick="return confirm('Voulez-vous vraiment supprimer cette formation ?');">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if (empty($formations)) { ?>
                            <tr>
                                <td colspan="6" class="empty">
                                    Aucune formation enregistrée.
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
