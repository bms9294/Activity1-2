function done(){
    var db = document.querySelector("#database").value;
    var user = document.querySelector("#mysqluser").value;
    var pass = document.querySelector("#password").nodeValue;
    var path = document.querySelector("#datapath").value;
    $.post("setup.php",{"database": db,
    "mysqluser":user,
    "mysqlpass": pass,
    "datapath": path}).done(function(data){
        var result = JSON.parse(data);
        if(!result.success){
            document.querySelector("#errormessage").innerHTML = result.message;
        }else{
            document.location.assign("/");
        }
    });
}

document.querySelector("#submit").addEventListener("click",done);