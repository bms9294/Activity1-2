var usercheck = false;
var emailcheck = false;
function userCheck() {
    return $.post("./core/login/dupecheck.php", { usercheck: document.getElementById("username").value }).done(function (data) {
        var result = JSON.parse(data);
        if (result.usercheck == true) {
            document.getElementById("username").style.borderColor = "rgb(50,235,50)";
            usercheck = true;
            return true;
        } else {
            document.getElementById("username").style.borderColor = "rgb(235,75,75)";
            usercheck = false;
            return false;
        }
    });
}
function emailCheck() {
    var mail = document.getElementById("emailinput").value;
    if (!mail.includes("@") || !mail.includes(".")) {
        document.getElementById("emailinput").style.borderColor = "rgb(235,75,75)";
        return false;
    } else {
        return $.post("./core/login/dupecheck.php", { emailcheck: document.getElementById("emailinput").value }).done(function (data) {
            var result = JSON.parse(data);
            if (result.emailcheck == true) {
                document.getElementById("emailinput").style.borderColor = "rgb(50,235,50)";
                emailcheck = true;
                return true;
            } else {
                document.getElementById("emailinput").style.borderColor = "rgb(235,75,75)";
                emailcheck = false;
                return false;
            }
        });
    }
}
function nameCheck() {
    var name = document.getElementById("firstname");
    if (name.value == "") {
        name.style.borderColor = "rgb(235,75,75)";
        return false;
    } else {
        name.style.borderColor = "#dbdbdb";
        return true;
    }
    return true;
}
function surnameCheck() {
    var name = document.getElementById("lastname");
    if (name.value == "") {
        name.style.borderColor = "rgb(235,75,75)";
        return false;
    } else {
        name.style.borderColor = "#dbdbdb";
        return true;
    }
    return true;
}
function passwordCheck() {
    var pass = document.getElementById("password");
    if (pass.value == "") {
        pass.style.borderColor = "rgb(235,75,75)";
        return false;
    } else if (pass.value.length < 8) {
        pass.style.borderColor = "rgb(235,75,75)";
        return false;
    }
    else {
        pass.style.borderColor = "#dbdbdb";
    }
    return true;
}

function submitReg() {
    return userCheck().then(emailCheck().then(
        function () {
            var one = usercheck;
            var two = emailcheck;
            var three = nameCheck();
            var four = surnameCheck();
            var five = passwordCheck();
            var six = confirmPass();
            if (one && two && three & four && five && six) {
                postResult();
            }
        }
    ));
}
function confirmPass() {
    var one = document.getElementById("password");
    var two = document.getElementById("passwordconf");
    if (one.value === two.value) {
        two.style.borderColor = "rgb(50,235,50)";
        return true;
    } else {
        two.style.borderColor = "rgb(235,75,75)";
        return false;
    }
}
function postResult() {
    $.post("./core/login/register.php", {
        username: document.getElementById("username").value,
        password: document.getElementById("password").value,
        email: document.getElementById("emailinput").value,
        firstname: document.getElementById("firstname").value,
        surname: document.getElementById("lastname").value
    }).done(function (data) {
        var result = JSON.parse(data);
        if (result.success) {
            document.location.assign("/login.html");
        }
    });
}
document.getElementById("emailinput").onchange = emailCheck;
document.getElementById("username").onchange = userCheck;
document.getElementById("submit").addEventListener("click", submitReg);
document.getElementById("firstname").onchange = nameCheck;
document.getElementById("lastname").onchange = surnameCheck;
document.getElementById("password").onchange = passwordCheck;
document.getElementById("passwordconf").onchange = confirmPass;