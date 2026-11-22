
<?php

require_once "../database/connexion.php";

$sql = "SELECT modules.*, formations.libelle AS formation
        FROM modules
        INNER JOIN formations
        ON modules.formation_id = formations.id_formation";

$stmt = $pdo->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des modules</title>
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
                GESTION <span>/</span> MODULES
            </div>
            <div class="topbar-date">Centre de formation</div>
        </header>

        <section class="page-heading">
            <div>
                <div class="eyebrow">ESPACE DE GESTION</div>
                <h1>Liste des modules</h1>
                <p>Consultez et gérez les modules des formations.</p>
            </div>

            <a href="create.php" class="btn btn-primary">
                + Ajouter un module
            </a>
        </section>

        <section class="content-card">

            <div class="card-head">
                <div>
                    <h2>Modules</h2>
                    <p>Liste des modules enregistrés</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Coefficient</th>
                            <th>Volume horaire</th>
                            <th>Formation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($modules as $module) { ?>
                            <tr>
                                <td><?= $module['id_module'] ?></td>
                                <td><strong><?= htmlspecialchars($module['nom']) ?></strong></td>
                                <td><?= htmlspecialchars($module['coefficient']) ?></td>
                                <td><?= htmlspecialchars($module['volume_horaire']) ?> h</td>
                                <td><?= htmlspecialchars($module['formation']) ?></td>
                                <td>
                                    <div class="actions">
                                        <a class="action-link" href="edit.php?id=<?= $module['id_module'] ?>">
                                            Modifier
                                        </a>

                                        <a class="action-link delete"
                                           href="delete.php?id=<?= $module['id_module'] ?>"
                                           onclick="return confirm('Voulez-vous vraiment supprimer ce module ?');">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if (empty($modules)) { ?>
                            <tr>
                                <td colspan="6" class="empty">
                                    Aucun module enregistré.
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
