
<?php
$fanTitle = "Login";
session_start();
$_SESSION['user'] = null;
include("templates/header.php");


if(isset($_POST['login_email']) && isset($_POST['login_password']) && !empty($_POST['login_password']) && !empty($_POST['login_email'])){
    $_SESSION['user'] = $_POST['login_email'];

    header("Location: index.php");
    exit;
}


?>
<div class="container h-100 align-items-center">
    <div class="row h-100 justify-content-center ">
        <div class="col-md-6 ikea-blue-bg pt-5">
            <span class="h3 font-weight-bold ikea-yellow-text">LOG IND MED DIN BRUGER</h3>
            <form action="login.php" method="post" class="mt-4">
                <div class="form-group"><input type="email" class="form-control" name="login_email" placeholder="Email" required></div>
                <div class="form-group"><input type="password" class="form-control" name="login_password" placeholder="Kodeord" required></div>
                <div class="form-group"><button type="submit" class="btn btn-block">Log ind</button></div>
            </form>
        </div>
        <div class="col-md-6 ikea-yellow-bg pt-5">
            <span class="h3 font-weight-bold ikea-blue-text">INGEN BRUGER? OPRET EN</span>
            <form action="login.php" method="post" class="mt-4">
                <div class="row form-group justify-content-around">
                    <div class="col-6">
                        <input name="create_firstname" type="text" class="form-control" placeholder="Fornavn">
                    </div>
                    <div class="col-6">
                        <input name="create_surname" type="text" class="form-control" placeholder="Efternavn">
                    </div>
                </div>
                <div class="form-group"><input name="create_email" type="email" class="form-control" placeholder="Email"></div>
                <div class="form-group"><input name="create_password" type="password" class="form-control" placeholder="Kodeord"></div>
                <div class="form-group"><div class="form-group"><button type="submit" class="btn btn-block">Opret bruger</button></div></div>
            </form>
        </div>
    </div>
</div>









<?php include("templates/footer.php"); ?>
