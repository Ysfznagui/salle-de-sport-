const $ = id => document.getElementById(id);

function calculer() {
  const genre = document.querySelector('input[name="genre"]:checked');
  const age = parseFloat($("age").value);
  const t = parseFloat($("taille").value);
  const p = parseFloat($("poids").value);

  if (!genre) return alert("Choisissez votre genre.");
  if (isNaN(age) || age < 15 || age > 50) return alert("Âge invalide (15 à 50 ans).");
  if (isNaN(t) || t < 0.5 || t > 2.5) return alert("Taille invalide (0,5 à 2,5 m).");
  if (isNaN(p) || p < 25 || p > 300) return alert("Poids invalide (25 à 300 kg).");
  if (!$("robot").checked) return alert("Cochez « Je ne suis pas un robot ».");

  const imc = p / (t * t);
  const homme = genre.value === "h";
  const img = 1.2 * imc + 0.23 * age - 10.8 * (homme ? 1 : 0) - 5.4;
  const [maigre, normal] = homme ? [15, 20] : [25, 30];

  let txt, couleur;
  if (img < maigre) { txt = "Trop maigre"; couleur = "#b3261e"; }
  else if (img < normal) { txt = "Normal"; couleur = "#1f6f4a"; }
  else { txt = "Trop de graisse"; couleur = "#b3261e"; }

  $("resultat").textContent = "IMG = " + img.toFixed(1) + " % — " + txt;
  $("resultat").style.color = couleur;
}

$("calc").addEventListener("click", calculer);
$("reset").addEventListener("click", () => { $("resultat").textContent = ""; });
