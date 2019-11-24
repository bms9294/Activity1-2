function login(){
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    $.post("./core/login/login.php", { username: user, password: pass }).done(function (data) {
        var result = JSON.parse(data);
        if (result.success) {
            if (document.referrer.includes(document.location.hostname + "/register.html")) {
                document.location.assign("/");
            } else if (document.referrer.includes(document.location.hostname)) {
                document.location.assign(document.referrer);
            } else {
                document.location.assign("/");
            }
        } 
        else 
        {
            document.getElementById("submitform").disable = true;
            document.getElementById("submitform").removeEventListener("click", login);
            setTimeout(timeout, 5000);
            document.getElementById("errormessage").innerHTML = result.message;
            setTimeout(function() {
                document.getElementById("errormessage").innerHTML = "Please wait...";
            }, 1500);

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


function timeout()
{
    document.getElementById("errormessage").innerHTML = "";
    document.getElementById("submitform").disable = false;
    document.getElementById("submitform").addEventListener("click", login);
}