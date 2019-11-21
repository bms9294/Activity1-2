var currentlyloaded = 0;

function loadList(user=false){
    var arr = {"start": currentlyloaded, "count": 50};
    if(user === true)arr['user'] = true;
    $.post("/core/video/requestList.php",arr).done(function(data){
        var result = JSON.parse(data);
        result.forEach(element => {
            if(element.thumbnail == "/")element.thumbnail = "/thumbnails/default.jpg";
            document.getElementById("videolist").innerHTML += " \
            <a href=/play.php?video="+element.videoID+" class=videoentry > \
                        <span> \
                            <h2>"+element.title+"</h2> \
                            <p class=description>Desc</p> \
                        </span> \
                        <img class=thumbnail src="+element.thumbnail+" > \
                    </a>"
            ;
            currentlyloaded++;
        });
    });
}
function userVids(){
    currentlyloaded = 0;
    document.getElementById("myvids").classList = "active";
    document.getElementById("recentvids").classList = "";
    document.getElementById("videolist").innerHTML = "";
    loadList(true);
}
function recentVids(){
    currentlyloaded = 0;
    document.getElementById("myvids").classList = "";
    document.getElementById("recentvids").classList = "active";
    document.getElementById("videolist").innerHTML = "";
    loadList();
}
loadList();


if(document.cookie.includes("logged-in=1")){
    document.getElementById("videotype").innerHTML += `<h2 id="myvids">My Videos</h2>`;
    document.getElementById("myvids").addEventListener("click", userVids);
    document.getElementById("recentvids").addEventListener("click", recentVids);
}else{
    document.getElementById("recentvids").addEventListener("click", recentVids);
}