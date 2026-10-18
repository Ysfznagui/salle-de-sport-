document.getElementById("authForm").addEventListener("submit", e => {
  const email = document.getElementById("email").value.trim();
  const pass = document.getElementById("password").value;
  const msg = document.getElementById("msg");
  let err = "";
  if (!/^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i.test(email)) err = "Email invalide.";
  else if (pass.length < 8 || !/[A-Za-z]/.test(pass) || !/\d/.test(pass))
    err = "Mot de passe : 8 caractères minimum, avec lettres et chiffres.";
  msg.textContent = err;
  if (err) e.preventDefault();
});
