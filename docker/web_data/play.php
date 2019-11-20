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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Videos4u - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <h1 class="title">Videos4u</h1>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="/" class="navbar-item">
                    Home
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="register.html" class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                        <a href="login.html" class="button is-light">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="hero-body">
        <div class="container">
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