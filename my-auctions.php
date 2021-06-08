<?php
session_start();
include("templates/header.php");
include("templates/profile-header.php");

if($_SESSION['user'] == ""){
  header("Location: index.php");
  exit();
}
?>
<div class="container">
    <div class="row">
      <div class="col h5 text-center font-weight-bold bg-light">
        Mine auktioner

      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-3 bg-light rounded">
        <div class="row">
          <div class="col mt-3 text-center">
            <img src="img/placeholder.png" alt="" class="img-thumbnail">
          </div>
        </div>
        <div class="row">
          <div class="col mt-3">
            <span class="font-weight-bold h3">
              Titel
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col mt-2">
            <div class="font-weight-bold">
            Beskrivelse
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col mt-2">
            <div class="font-weight-bold">
            Pris
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col my-2 ">
            <div class="font-weight-bold">
            Udløbsdato
            </div>
          </div>
        </div>
    </div>
  </div>


<hr>
<div class="container-fluid">
<h5 class="text-center font-weight-bold ikea-yellow-bg">Auktioner du har budt på eller vundet</h5>
  <div class="col mt-3">


  </div>
  </div>
</div>

<div class="container bg-light pt-4 rounded">
  <div class="row">
    <div class="col-6">
      <div class="font-weight-bold">
      Senest vundne
      </div>
    </div>
    <div class="col-2">
      <div class="font-weight-bold">
      Pris
    </div>
    </div>
    <div class="col">
      <div class="font-weight-bold">
      Vundet/Budt
    </div>
    </div>
    <div class="col-2">
      <div class="font-weight-bold">
      Lukket tidspunkt
    </div>
    </div>
    <div class="col-2">
    </div>
  </div>
  <hr>
  <?php
  if(count(getWonAuctionsByUser($_SESSION['user']))>0){
    for($i = 1; $i < count(getWonAuctionsByUser($_SESSION['user']));$i++){
      $img ="placeholder.png";
      $title = "Titel";
      $description = "beskrivelse";
      $price = 200;
      $status = "Vundet";
      $end_time = "dato";
      include("components/won-lost.php");
    }
  }
  debug(getUsersCurrentBids($_SESSION['user']));
  $bidsByUser = getUsersCurrentBids($_SESSION['user']);
  $added = array();
  foreach($bidsByUser as $x => $val){
    if(!in_array($bidsByUser[$x]['auction_id'], $added)){
      echo $bidsByUser[$x]['auction_id'];
      $added[] = $bidsByUser[$x]['auction_id'];
    }
  }
  
  if(count(getWonAuctionsByUser($_SESSION['user']))>0){
    for($i = 1; count(getWonAuctionsByUser($_SESSION['user']));$i++){
      $img ="placeholder.png";
      $title = "Titel";
      $description = "beskrivelse";
      $price = 200;
      $status = "Budt";
      $end_time = "dato";
      include("components/won-lost.php");
    }
  }

      
  ?>
</div>










<?php
include("templates/footer.php");
?>
