<?php

session_start();

include("templates/header.php");
include("templates/profile-header.php");
$userDetails = getUserDetails($_SESSION['user']);
$adressDetails = getAdressByUser($userDetails[0]['address_id']);
$city = getCityByZip($adressDetails[0]['zip_code'])[0]['city_name'];

if($_SESSION['user'] == ""){
  header("Location: index.php");
  exit();
}
if(isset($_POST['updateBtn'])){
  if(strlen($_POST['phone_number'])==8) {
  updateUser($_POST['Street_name'], $_POST['street_name2'], $_POST['House_number'], $_POST['zip_code'], $_POST['firstname'], $_POST['surname'], $_POST['password'], $_POST['email'], $_POST['phone_number'], $userDetails[0]['address_id'], $_SESSION['user']);
  header("Refresh:0");
  }
}
?>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="profile.php" method="post" class="mt-4" >
            <div class="row">
              <div class="col text-center h3 mb-4">
                Profilændringer
              </div>

            </div>
            <div class="row form-group justify-content-around">
                <div class="col-6">
                    <input name="firstname" type="text" class="form-control" placeholder="Fornavn" value="<?php echo $userDetails[0]['first_name']; ?>" required>
                </div>
                <div class="col-6">
                    <input name="surname" type="text" class="form-control" placeholder="Efternavn" value="<?php echo $userDetails[0]['last_name']; ?>" required>
                </div>
            </div>
            <div class="form-group">
              <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $userDetails[0]['email']; ?>" required>
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="Tast et ny kodeord">
            </div>
            <div class="form-group">
              <input name="phone_number" type=number class="form-control" placeholder="Telefonnummer" value="<?php echo $userDetails[0]['phone_number']; ?>" required>
            </div>
            <div class="form-group row justify-content-around">
              <div class="col-8">
                <input name="Street_name" type="address" class="form-control" placeholder="Adresse" value="<?php echo $adressDetails[0]['street_name']; ?>" required>
              </div>
              <div class="col-4">
                <input name="House_number" type="House_number" class="form-control" placeholder="Hus nr." value="<?php echo $adressDetails[0]['house_number'] ?>" required>
              </div>


            </div>
              <div class="form-group">
                <input name="street_name2" type="address" class="form-control" placeholder="Adresse 2" value="<?php echo $adressDetails[0]['street_name2']; ?>">
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
              <input name="zip_code" type="zipcode" class="form-control" placeholder="Postnummer" value="<?php echo $adressDetails[0]['zip_code']; ?>" required>
            </div>
            <div class="form-group">
              <input name="City_name" value="<?php echo $city ?>" type="cityname" class="form-control" disabled>
            </div>
            <div class="form-group">
              <button type="submit" name="updateBtn" class="btn btn-block">Gem ændringer</button>
            </div>
        </form>
      </div>
    </div>


<?php
include("templates/footer.php");

 ?>
