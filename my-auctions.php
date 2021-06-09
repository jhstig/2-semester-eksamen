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
    <div class="row justify-content-around">
      <?php
      $ownAuctions = getAuctionsOwnedByUser($_SESSION['user']);
      foreach($ownAuctions as $x => $val){
        $auction_id = $ownAuctions[$x]['auction_id'];
        $img = getAuctionDetailsById($auction_id)[0]['image'];
        $title = getAuctionDetailsById($auction_id)[0]['title'];
        $description = getAuctionDetailsById($auction_id)[0]['description'];
        if(count(getGreatestBid($auction_id))>0){
          $price = getGreatestBid($auction_id)[0]['bid_amount'];
        } else {
          $price = getMinBid($auction_id)[0]['min_bid'];
        }
        //$price = getGreatestBid($auction_id)[0]['bid_amount'];
        $end_time = getAuctionDetailsById($auction_id)[0]['expiration_date'];
        if(checkIfWon($auction_id)[0]['won_by'] != null){
          $winner = checkIfWon($auction_id)[0]['won_by'];
          $wonBy = getNameFromAuction($winner)[0]['first_name'];
          $wonBy = $wonBy . " " . getNameFromAuction($winner)[0]['last_name'];
          $adressID = getAdressId($winner)[0]['address_id'];
          $winnerAdressDetails = getAdressByUser($adressID);
          $winnerCity = getCityByZip($winnerAdressDetails[0]['zip_code'])[0]['city_name'];
          $telephone = getPhoneFromAuction($winner)[0]['phone_number']; 
          
          $address = $wonBy . "<br>" . $winnerAdressDetails[0]['street_name'] . " " . $winnerAdressDetails[0]['house_number'] . "<br>" . $winnerAdressDetails[0]['zip_code'] . " " . $winnerCity . "<br>" . $telephone;
          
          
          
          
        } else {
          $wonBy = "";
        }

        include("components/own-auctions.php");
      } ?>

      
      <?php ?>
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
  $wonAuctions = getWonAuctionsByUser($_SESSION['user']);
  if(count($wonAuctions)>0){
    foreach($wonAuctions as $x => $val){
      $auctionid = $wonAuctions[$x]['auction_id'];
      $img = getAuctionDetailsById($auctionid)[0]['image'];
      $title = getAuctionDetailsById($auctionid)[0]['title'];
      $description = getAuctionDetailsById($auctionid)[0]['description'];
      $price = "Du har vundet med budet ".getGreatestBid($auctionid)[0]['bid_amount']." kr";
      $status = "Vundet";
      $end_time = getAuctionDetailsById($auctionid)[0]['expiration_date'];
      
      include("components/won-lost.php");
    }
  }

  $bidsByUser = getUsersCurrentBids($_SESSION['user']);
  $added = array();
  foreach($bidsByUser as $x => $val){
    $auctionid = $bidsByUser[$x]['auction_id'];
    if(checkIfWon($auctionid)[0]['won_by'] != $_SESSION['user']){ //tjekker at auktionen ikke er vundet af brugeren der er logget ind, så den ikke kommer ind i added-array
      if(!in_array($bidsByUser[$x]['auction_id'], $added)){
        $added[] = $bidsByUser[$x]['auction_id'];
      }
    }
  }
  if(count($added)>0){
    foreach($added as $x => $val){
      $img = getAuctionDetailsById($val)[0]['image'];
      $title = getAuctionDetailsById($val)[0]['title'];
      $description = getAuctionDetailsById($val)[0]['description'];
      $price = "Du har budt " . getUsersCurrentBidOnAuction($_SESSION['user'], $val)[0]['bid_amount'] . " kr.";
      if(checkIfWon($val)[0]['won_by'] == null) { //tjekker at auktionen ikke er vundet af en anden
        if(getGreatestBid($val)[0]['bid_amount']==$price){
          $status = "Du har det højeste bud";
        } else {
          $status = "Du er blevet overbudt";
        }
      } else {
        $status = "Du har tabt auktionen";
      }
      
      
      $end_time = getAuctionDetailsById($val)[0]['expiration_date'];
      include("components/won-lost.php");
    }
  }
  ?>
</div>










<?php
include("templates/footer.php");
?>
