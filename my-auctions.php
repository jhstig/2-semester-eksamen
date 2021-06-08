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
      <div class="col h5 text-center font-weight-bold bg-light rounded">
        Dine auktioner
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
            Højeste bud: 100 kr.
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
  </div>
</div>

<hr>
<div class="container">
  <div class="row">
    <div class="col h5 text-center font-weight-bold ikea-yellow-bg rounded">
      Auktioner du har budt på eller vundet
    </div>
  </div>
</div>
<div class="container bg-light pt-4 rounded">
  <div class="row">
    <div class="col-6">
      <div class="font-weight-bold">
      Vundne/budte auktioner
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
      $status = "Du har vundet auktionen";
      $end_time = "dato";
      include("components/won-lost.php");
    }
  }
  //debug(getUsersCurrentBids($_SESSION['user']));
  $bidsByUser = getUsersCurrentBids($_SESSION['user']);
  $added = array();
  foreach($bidsByUser as $x => $val){
    if(!in_array($bidsByUser[$x]['auction_id'], $added)){
      $added[] = $bidsByUser[$x]['auction_id'];
    }
  }
  if(count($added)>0){
    foreach($added as $x => $val){
      $img = getAuctionDetailsById($val)[0]['image'];
      $title = getAuctionDetailsById($val)[0]['title'];
      $description = getAuctionDetailsById($val)[0]['description'];
      
      $price =  getUsersCurrentBidOnAuction($_SESSION['user'], $val)[0]['bid_amount'];
   
      
      //getUsersCurrentBids($_SESSION['user'])[0]['bid_amount'];

      if(getGreatestBid($val)[0]['bid_amount']==$price){
        $status = "Du har det højeste bud";
      } else {
        $status = "Du er blevet overbudt";
      }
      
      $end_time = "dato";
      include("components/won-lost.php");
    }
  }
  ?>
</div>










<?php
include("templates/footer.php");
?>
