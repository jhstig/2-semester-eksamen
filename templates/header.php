<?php

$fanTitle;
include("scripts/functions.php");

$inclDB = true;

if($inclDB == true) {

    define('DBHOST', 'localhost');
    define('DBPASS', 'root');
    define('DBUSER', 'root');
    define('DBNAME', 'ikeadb');

    connect();
}
//html_entity_decode();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fanTitle;?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylesheet.css">
</head>

<body class="containter-fluid">
    <nav class="navbar navbar-expand-md navbar-bright border-bottom ikea-yellow-bg">
        <a class="navbar-brand" href="index.php"><span class="font-weight-bold ikea-blue-text">IKEA</span> Second Hand Market</a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse float-right" id="collapsibleNavbar">
            <ul class="nav navbar-nav ml-auto">
                <?php if($_SESSION['user'] != null){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php" >Din profil</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" >Se auktioner</a>
                </li>

                <li class="nav-item">
                    <?php if($_SESSION['user'] == null){
                        echo '<a class="nav-link" href="login.php">Log ind</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php">Log ud</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
