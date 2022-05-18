window.onload = function() {
    var infoButton = document.getElementById("infoButton");
    var loginButton = document.getElementById("loginButton");

    infoButton.onclick = function() {
        document.querySelector("#flipper").classList.toggle("flip");
    }

    loginButton.onclick = function() {
        document.querySelector("#flipper").classList.toggle("flip");
    }
}