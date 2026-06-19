<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['titre']) ?> — EspNews</title>
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
            <span class="badge badge-<?= strtolower($article['libelle']) ?>">
                <?= htmlspecialchars($article['libelle']) ?>
            </span>
            <span class="date">Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?></span>
        </div>
        <h1><?= htmlspecialchars($article['titre']) ?></h1>
        <div class="contenu">
            <?= nl2br(htmlspecialchars($article['contenu'])) ?>
        </div>
    </div>
</main>

<footer>
    <p>© <?= date('Y') ?> EspNews — École Supérieure Polytechnique de Dakar</p>
</footer>

</body>
</html>