
<?php
$fanTitle = "Login";
session_start();
$_SESSION['user'] = null;
include("templates/header.php");

$loginMessage = null;
if(isset($_POST['loginBtn'])) { 
  $passString = $_POST['login_password'];
  if(count(getPasswordByEmail($_POST['login_email']))>0){
    $passHashed = getPasswordByEmail($_POST['login_email'])[0]['password'];
    if(password_verify($passString, $passHashed)) {
        $_SESSION['user'] = getUserIdByEmail($_POST['login_email'])[0]['user_id'];
        
        header('Location: index.php');
        exit();
    } else {
      $loginMessage = "Kodeordet er forkert, eller brugeren eksisterer ikke";
    }
  } else {
    $loginMessage = "Kodeordet er forkert, eller brugeren eksisterer ikke";
  }
}

if (isset($_POST['create_firstname']) && !empty($_POST['create_firstname'])) {
$firstname = $_POST['create_firstname'];
$lastname = $_POST['create_surname'];
$email = $_POST['create_email'];
$password = $_POST['create_password'];
$phonenumber = $_POST['phone_number'];
$streetname = $_POST['Street_name'];
$streetname2 = $_POST['Street_name2'];
$zipcode = $_POST['zip_code'];
$cityname = $_POST['City_name'];
$housenumber = $_POST['House_number'];

insertaddresses($streetname, $streetname2, $housenumber, $zipcode, $firstname, $lastname, $password, $email, $phonenumber);
}


?>
<div class="container h-100 align-items-center">
    <div class="row h-100 justify-content-center ">
        <div class="col-md-6 ikea-blue-bg pt-5">
            <span class="h3 font-weight-bold ikea-yellow-text">LOG IND MED DIN BRUGER</h3>
            <form action="login.php" method="post" class="mt-4">
                <div class="form-group"><input type="email" class="form-control" name='login_email' placeholder="Email" required></div>
                <div class="form-group"><input type="password" class="form-control" name='login_password' placeholder="Kodeord" required></div>
                <div class="form-group"><button type="submit" name="loginBtn" class="btn btn-block">Log ind</button></div>
                <div class="form-group"><?php echo $loginMessage; ?></div>
            </form>
        </div>
        <div class="col-md-6 ikea-yellow-bg pt-5">
            <span class="h3 font-weight-bold ikea-blue-text">INGEN BRUGER? OPRET EN</span>
            <form action="login.php" method="post" class="mt-4" >
                <div class="row form-group justify-content-around">
                    <div class="col-6">
                        <input name="create_firstname" type="text" class="form-control" placeholder="Fornavn" required>
                    </div>
                    <div class="col-6">
                        <input name="create_surname" type="text" class="form-control" placeholder="Efternavn" required>
                    </div>
                </div>
                <div class="form-group">
                  <input name="create_email" type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input name="create_password" type="password" class="form-control" placeholder="Kodeord" required>
                </div>
                <div class="form-group">
                  <input name="phone_number" type=number class="form-control" placeholder="Telefonnummer" required>
                </div>
                <div class="form-group">
                  <input name="Street_name" type="address" class="form-control" placeholder="Adresse" required>
                </div>
                  <div class="form-group">
                    <input name="Street_name2" type="address" class="form-control" placeholder="Adresse 2">
              </div>
                <div class="form-group">
                  <input name="House_number" type="House_number" class="form-control" placeholder="Hus nr." required>
                </div>
                <div class="form-group">
                  <input name="zip_code" type="zipcode" class="form-control" placeholder="Postnummer" required>
                </div>
                <div class="form-group"><div class="form-group"><button type="submit" name="createBtn" class="btn btn-block">Opret bruger</button></div></div>
            </form>
        </div>
    </div>
</div>









<?php include("templates/footer.php"); ?>
