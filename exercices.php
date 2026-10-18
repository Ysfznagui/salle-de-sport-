<?php
$title = 'Exercices'; require 'includes/header.php';
$rows = $pdo->query('SELECT nom, image FROM exercices ORDER BY nom')->fetchAll();
?>
<h1>Exercices de notre salle</h1>
<?php if (!$rows): ?><p>Aucun exercice pour le moment.</p><?php endif; ?>
<div class="grid">
<?php foreach ($rows as $r): ?>
  <figure class="card">
    <img src="assets/img/<?= e($r['image']) ?>" alt="<?= e($r['nom']) ?>">
    <figcaption><?= e($r['nom']) ?></figcaption>
  </figure>
<?php endforeach; ?>
</div>
<?php require 'includes/footer.php'; ?>
