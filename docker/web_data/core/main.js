function isLoggedIn(){
    if(document.cookie.includes("logged-in=1")){
        document.getElementById("login-menu").innerHTML = "<a href=videoUpload.html class=primary><strong>Upload</strong></a>";
    }
    $.get("/core/session/challenge.php").done(function(data){
        var result = JSON.parse(data);
        if(!result.success){
            document.getElementById("login-menu").innerHTML = `<a href="register.html" class="primary">
                                                                    <strong>Sign up</strong>
                                                                </a>
                                                                <a href="login.html" class="light">
                                                                    Log in
                                                                </a>`;
        }
    });
}
isLoggedIn();