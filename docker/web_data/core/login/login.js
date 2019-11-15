function login(){
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    $.post("./core/login/login.php", {username: user, password: pass}).done(function (data) {
        alert(data);
    });
}
function enterListener() {

}


document.getElementById("password").addEventListener("keyup", function (e) {
    var key = e.which || e.keyCode;
    if (key == 13) login();
});
document.getElementById("username").addEventListener("keyup", function (e) {
    var key = e.which || e.keyCode;
    if (key == 13) login();
});
document.getElementById("submitform").addEventListener("click", login);