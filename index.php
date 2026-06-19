<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EspNews</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo">
            <h1>ESP<span>News</span></h1>
            <p>Actualités de l'École Supérieure Polytechnique de Dakar</p>
        </div>
    </div>
</header>

<nav class="categories">
    <a href="index.php" <?= !isset($_GET['categorie']) ? 'class="active"' : '' ?>>Tous</a>
    <?php
    $cats = $conn->query("SELECT * FROM Categorie ORDER BY libelle");
    while ($cat = $cats->fetch_assoc()):
    ?>
    <a href="index.php?categorie=<?= $cat['id'] ?>"
       <?= (isset($_GET['categorie']) && $_GET['categorie'] == $cat['id']) ? 'class="active"' : '' ?>>
        <?= htmlspecialchars($cat['libelle']) ?>
    </a>
    <?php endwhile; ?>
</nav>

<main class="container">
    <h2 class="section-titre">Dernières actualités</h2>
    <?php
    if (isset($_GET['categorie']) && is_numeric($_GET['categorie'])) {
        $cat_id = (int)$_GET['categorie'];
        $sql = "SELECT a.*, c.libelle FROM Article a
                JOIN Categorie c ON a.categorie = c.id
                WHERE a.categorie = $cat_id
                ORDER BY a.dateCreation DESC";
    } else {
        $sql = "SELECT a.*, c.libelle FROM Article a
                JOIN Categorie c ON a.categorie = c.id
                ORDER BY a.dateCreation DESC";
    }
    $articles = $conn->query($sql);

    if ($articles->num_rows === 0): ?>
        <p class="vide">Aucun article dans cette catégorie.</p>
    <?php else: ?>
    <div class="grille">
        <?php while ($art = $articles->fetch_assoc()): ?>
        <article class="carte">
            <div class="carte-top">
                <span class="badge badge-<?= strtolower($art['libelle']) ?>">
                    <?= htmlspecialchars($art['libelle']) ?>
                </span>
                <span class="date"><?= date('d/m/Y', strtotime($art['dateCreation'])) ?></span>
            </div>
            <h2><?= htmlspecialchars($art['titre']) ?></h2>
            <p class="extrait"><?= htmlspecialchars(substr($art['contenu'], 0, 130)) ?>…</p>
            <a href="article.php?id=<?= $art['id'] ?>" class="lire">Lire l'article →</a>
        </article>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</main>

<footer>
    <p>© <?= date('Y') ?> EspNews — École Supérieure Polytechnique de Dakar</p>
</footer>

</body>
</html>