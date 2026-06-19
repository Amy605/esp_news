<?php
require_once 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id  = (int)$_GET['id'];
$res = $conn->query("SELECT a.*, c.libelle FROM Article a
                     JOIN Categorie c ON a.categorie = c.id
                     WHERE a.id = $id");

if ($res->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$art = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($art['titre']) ?> — ESP News</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo">
            <h1><a href="index.php">ESP<span>News</span></a></h1>
            <p>Actualités de l'École Supérieure Polytechnique de Dakar</p>
        </div>
    </div>
</header>

<main class="container">
    <a href="index.php" class="retour">← Retour aux articles</a>
    <div class="article-complet">
        <div class="carte-top">
            <span class="badge badge-<?= strtolower($art['libelle']) ?>">
                <?= htmlspecialchars($art['libelle']) ?>
            </span>
            <span class="date">Publié le <?= date('d/m/Y à H:i', strtotime($art['dateCreation'])) ?></span>
        </div>
        <h1><?= htmlspecialchars($art['titre']) ?></h1>
        <div class="contenu">
            <?= nl2br(htmlspecialchars($art['contenu'])) ?>
        </div>
    </div>
</main>

<footer>
    <p>© <?= date('Y') ?> ESPNews — École Supérieure Polytechnique de Dakar</p>
</footer>

</body>
</html>