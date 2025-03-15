btnback = document.getElementById("back");

function Return(){
    history.back()
}
btnback.addEventListener("click", Return);