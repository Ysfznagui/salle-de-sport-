const $ = id => document.getElementById(id);

function calculerAge(d) {
  const n = new Date();
  let age = n.getFullYear() - d.getFullYear();
  if (n.getMonth() < d.getMonth() || (n.getMonth() === d.getMonth() && n.getDate() < d.getDate())) age--;
  return age;
}

function maj() {
  const v = $("naissance").value;
  if (!v) { $("categorie").value = ""; $("prix").value = ""; $("anniv").textContent = ""; return; }
  const d = new Date(v);
  const age = calculerAge(d);
  $("categorie").value = age < 15 ? "enfant" : "adulte";

  const n = new Date();
  $("anniv").textContent = (n.getMonth() === d.getMonth() && n.getDate() === d.getDate())
    ? "Joyeux anniversaire !" : "";

  const duree = document.querySelector('input[name="duree"]:checked');
  $("prix").value = duree ? (age < 15 ? 50 : 70) * Number(duree.value) + " DT" : "";
}

$("naissance").addEventListener("change", maj);
document.querySelectorAll('input[name="duree"]').forEach(r => r.addEventListener("change", maj));
$("aboForm").addEventListener("reset", () => setTimeout(maj));
$("aboForm").addEventListener("submit", e => {
  if (!$("naissance").value) { e.preventDefault(); alert("Saisissez votre date de naissance."); }
  else if (!$("sport").value) { e.preventDefault(); alert("Choisissez un sport."); }
  else if (!document.querySelector('input[name="duree"]:checked')) { e.preventDefault(); alert("Choisissez une durée."); }
});
