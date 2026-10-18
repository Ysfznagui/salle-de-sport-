<?php require_once __DIR__ . '/db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Salle de sport') ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="top">
  <a class="logo" href="index.php">Salle de sport</a>
  <nav>
    <a href="exercices.php">Exercices</a>
    <a href="imc.php">Calcul IMG</a>
    <a href="abonnement.php">Abonnement</a>
    <?php if (!empty($_SESSION['user_id'])): ?>
      <a href="logout.php">Déconnexion</a>
    <?php else: ?>
      <a href="login.php">Connexion</a>
    <?php endif; ?>
  </nav>
</header>
<main>
