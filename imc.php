<?php $title = 'Calcul IMG'; require 'includes/header.php'; ?>
<form class="card" id="imgForm" onsubmit="return false">
  <h2>Calcul de l'indice de masse grasse</h2>
  <fieldset>
    <legend>Vous êtes</legend>
    <label class="inline"><input type="radio" name="genre" value="h"> Homme</label>
    <label class="inline"><input type="radio" name="genre" value="f"> Femme</label>
  </fieldset>
  <label>Âge <input type="number" id="age" min="15" max="50"></label>
  <label>Taille (m) <input type="number" id="taille" step="0.01" min="0.5" max="2.5"></label>
  <label>Poids (kg) <input type="number" id="poids" step="0.1" min="25" max="300"></label>
  <label class="inline"><input type="checkbox" id="robot"> Je ne suis pas un robot</label>
  <div class="row">
    <button class="btn" type="button" id="calc">Calculer</button>
    <button class="btn ghost" type="reset" id="reset">Réinitialiser</button>
  </div>
  <p class="result" id="resultat"></p>
</form>
<script src="assets/js/imc.js"></script>
<?php require 'includes/footer.php'; ?>
