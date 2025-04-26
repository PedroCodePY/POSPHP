btn = document.getElementById("BTN");
btn2 = document.getElementById("BTN2");

function Return(){
    location.href = "../Menu/Product.php";
}

function Return2(){
    location.href = "../Menu/Users.php";
}

btn.addEventListener('click', Return)
btn2.addEventListener('click', Return2);