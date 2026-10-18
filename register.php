<?php
$title = 'Créer un compte'; require 'includes/header.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $err = 'Email invalide.';
    elseif (strlen($pass) < 8 || !preg_match('/[A-Za-z]/', $pass) || !preg_match('/\d/', $pass))
        $err = 'Mot de passe : 8 caractères minimum, avec lettres et chiffres.';
    else {
        $st = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $st->execute([$email]);
        if ($st->fetch()) $err = 'Cet email est déjà utilisé.';
        else {
            $pdo->prepare('INSERT INTO users (email, password_hash) VALUES (?, ?)')
                ->execute([$email, password_hash($pass, PASSWORD_DEFAULT)]);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            header('Location: abonnement.php'); exit;
        }
    }
}
?>
<form method="post" class="card" id="authForm">
  <h2>Créer un compte</h2>
  <?php if ($err): ?><p class="error"><?= e($err) ?></p><?php endif; ?>
  <label>Email <input type="email" name="email" id="email" required value="<?= e($_POST['email'] ?? '') ?>"></label>
  <label>Mot de passe <input type="password" name="password" id="password" required minlength="8"></label>
  <p class="error" id="msg"></p>
  <button class="btn" type="submit">Créer mon compte</button>
  <p class="hint">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
</form>
<script src="assets/js/auth.js"></script>
<?php require 'includes/footer.php'; ?>
