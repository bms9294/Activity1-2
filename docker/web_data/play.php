<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("./core/mysql/client.php");
if(!isset($_GET["video"])){
    header("Location: /");
}

$video = $_GET["video"];
$mysql = new MySqlClient("tables/video.php");
try{
    $mysql->connect();
    $mysql->prepare("getVideo");
    $row = ($mysql->exec([$video]))->fetch();
    if($row){
        $title = $row['title'];
        $upload_date = $row['upload_date'];
        $user = $row['username'];
        $path = $row['pathToVideo'];
    }else{
        header("Location: /");
    }

}catch(\PDOException $e){

}


?>
<html>
<head>
    <link rel="stylesheet" href="/core/style.css" >
    <link href="https://fonts.googleapis.com/css?family=Varela&display=swap" rel="stylesheet"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Videos4u - <?php echo $title ?></title>
</head>
<body>
    <nav class="navbar">
        <div class=left>
            <a href="/">
                <h1>Videos4u</h1>
            </a>
            <div class="menu">
                <a href="/">
                    Home
                </a>
            </div>
        </div>
        <div class="navbar-menu">
            <div class="right">
            <div id="login-menu" class="button">
                        <a href="register.html" class="primary">
                            <strong>Sign up</strong>
                        </a>
                        <a href="login.html" class="light">
                            Log in
                        </a>
                    </div>
                    <script src="/core/head.js" ></script>
            </div>
        </div>
    </nav>
<div class=content>
    <div class=backdrop> 
            <div class=player>
                <video class=mainvid controls>
                    <source src=<?php echo $path ?> >
                </video>
            </div>
    </div>
</div>
    <footer class="footer">
        <div class="content has-text-centered">
            
        </div>
    </footer>
</body>
</html>