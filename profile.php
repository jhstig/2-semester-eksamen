<?php

session_start();

include("templates/header.php");
include("templates/profile-header.php");
 ?>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="login.php" method="post" class="mt-4" >
            <div class="row">
              <div class="col text-center h3 mb-4">
                Profilændringer
              </div>

            </div>
            <div class="row form-group justify-content-around">
                <div class="col-6">
                    <input name="create_firstname" type="text" class="form-control" placeholder="Fornavn" value="" required>
                </div>
                <div class="col-6">
                    <input name="create_surname" type="text" class="form-control" placeholder="Efternavn" required>
                </div>
            </div>
            <div class="form-group">
              <input name="create_email" type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="Kodeord" required>
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
            <div class="form-group">
              <input name="City_name" type="cityname" class="form-control" placeholder="By"required>
            </div>
            <div class="form-group"><div class="form-group"><button type="submit" class="btn btn-block">Gem ændringer</button></div></div>
        </form>
      </div>
    </div>


<?php
include("templates/footer.php");

 ?>
