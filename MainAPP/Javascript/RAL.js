btn1 = document.getElementById("A1");
btn2 = document.getElementById("A2");
btncon = document.getElementById("btn");

function check(){
    if (btn1.value == "True" && btn2.value == "True"){
        document.getElementById("error").innerText = ""
    }else{
        document.getElementById("error").innerText = "Please agree to the contract"
    }
}
btncon.addEventListener("click", check)