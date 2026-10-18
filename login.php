<?php
$title = 'Connexion'; require 'includes/header.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $st = $pdo->prepare('SELECT id, password_hash FROM users WHERE email = ?');
    $st->execute([trim($_POST['email'] ?? '')]);
    $u = $st->fetch();
    if ($u && password_verify($_POST['password'] ?? '', $u['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $u['id'];
        header('Location: abonnement.php'); exit;
    }
    $err = 'Email ou mot de passe incorrect.';
}
?>
<form method="post" class="card">
  <h2>Connexion</h2>
  <?php if ($err): ?><p class="error"><?= e($err) ?></p><?php endif; ?>
  <label>Email <input type="email" name="email" required></label>
  <label>Mot de passe <input type="password" name="password" required></label>
  <button class="btn" type="submit">Se connecter</button>
  <p class="hint">Pas de compte ? <a href="register.php">Créer un compte</a></p>
</form>
<?php require 'includes/footer.php'; ?>
