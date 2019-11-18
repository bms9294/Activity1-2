function login(){
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    $.post("./core/login/login.php", { username: user, password: pass }).done(function (data) {
        var result = JSON.parse(data);
        if (result.success) {
            if (document.referrer.includes(document.location.hostname)) {
                document.location.assign(document.referrer);
            }
        } else {
            document.getElementById("errormessage").innerHTML = result.message;
        }
    });
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