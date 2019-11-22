function isLoggedIn(){
    if(document.cookie.includes("logged-in=1")){
        document.getElementById("login-menu").innerHTML = "<a id=exterminate class=primary>Delete Video</a><a href=videoUpload.html class=primary><strong>Upload</strong></a><a id=logout class=light>Logout</a>";
        document.getElementById("logout").addEventListener("click",logout);
        document.getElementById("exterminate").addEventListener("click",exterminate);
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

function logout(){
    $.post("logout.php").done(function(data){
        var result = JSON.parse(data);
        if(result.success){
            document.location.assign("/index.html");
        }
    });
}
function exterminate(){
    document.getElementById("login-menu").innerHTML = "<input class=navinput id=todelete placeholder='Video ID' ></input><a id=confirm class=primary>Confirm</a>"+document.getElementById("login-menu").innerHTML;
    document.getElementById("confirm").addEventListener("click",confirm);
}

function confirm(){
    var id = document.getElementById("todelete").value;
    $.post("/core/deleteVideo.php",{"video":id},function(data){
        var result = JSON.parse(data);
        document.getElementById("todelete").remove();
            document.getElementById("confirm").remove();
        if(result.success){
            
        }else{

        }
    });
}
isLoggedIn();