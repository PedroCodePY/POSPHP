let Error = document.getElementById('error');
let email = document.getElementById('username');
let password = document.getElementById('password');
let LoginForm = document.getElementById('LoginForm');
let hideshow = document.getElementById('ShowHide');

async function showhidepass() {
  if (password.type === "password") {
    password.type = "text";
    hideshow.src = '../Asset/eye-crossed.png';
  } else {
    password.type = "password";
    hideshow.src = '../Asset/eye.png';
  };
};

hideshow.addEventListener('click', showhidepass);