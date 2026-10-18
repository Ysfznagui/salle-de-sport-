<?php
$title = 'Abonnement'; require 'includes/header.php';
require_login();
$sports = $pdo->query('SELECT id, nom FROM sports ORDER BY id')->fetchAll();
$msg = $err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dn    = $_POST['naissance'] ?? '';
    $sport = (int)($_POST['sport'] ?? 0);
    $duree = (int)($_POST['duree'] ?? 0);
    $d = DateTime::createFromFormat('Y-m-d', $dn);
    if (!$d || $d > new DateTime()) $err = 'Date de naissance invalide.';
    elseif (!in_array($duree, [1, 3], true)) $err = 'Choisissez une durée.';
    else {
        $ok = $pdo->prepare('SELECT id FROM sports WHERE id = ?'); $ok->execute([$sport]);
        if (!$ok->fetch()) $err = 'Choisissez un sport.';
        else {
            $age  = $d->diff(new DateTime())->y;           // âge exact
            $cat  = $age < 15 ? 'enfant' : 'adulte';
            $prix = ($cat === 'enfant' ? 50 : 70) * $duree;
            $pdo->prepare('INSERT INTO abonnements (user_id, sport_id, date_naissance, categorie, duree_mois, prix) VALUES (?,?,?,?,?,?)')
                ->execute([$_SESSION['user_id'], $sport, $dn, $cat, $duree, $prix]);
            $msg = "Abonnement enregistré ($cat, $duree mois) : $prix DT.";
        }
    }
}
?>
<form method="post" class="card" id="aboForm">
  <h2>Abonnement</h2>
  <?php if ($msg): ?><p class="ok"><?= e($msg) ?></p><?php endif; ?>
  <?php if ($err): ?><p class="error"><?= e($err) ?></p><?php endif; ?>
  <p class="ok" id="anniv"></p>
  <label>Date de naissance <input type="date" name="naissance" id="naissance" max="<?= date('Y-m-d') ?>" required></label>
  <label>Catégorie <input type="text" id="categorie" readonly></label>
  <label>Sport
    <select name="sport" id="sport" required>
      <option value="">Choisir…</option>
      <?php foreach ($sports as $s): ?>
        <option value="<?= (int)$s['id'] ?>"><?= e($s['nom']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <fieldset>
    <legend>Durée</legend>
    <label class="inline"><input type="radio" name="duree" value="1"> 1 mois</label>
    <label class="inline"><input type="radio" name="duree" value="3"> 3 mois</label>
  </fieldset>
  <label>Vous devez payer <input type="text" id="prix" readonly></label>
  <div class="row">
    <button class="btn" type="submit">Valider</button>
    <button class="btn ghost" type="reset">Annuler</button>
  </div>
</form>
<script src="assets/js/abonnement.js"></script>
<?php require 'includes/footer.php'; ?>
