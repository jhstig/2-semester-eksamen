<?php
    session_start();
    include("templates/header.php");

    if(isset($_POST['formBtn'])){
        $bid_amount = $_POST['formBid'];
        $auction_id = $_POST['auctionid'];
        $bid_owner = $_SESSION['user'];
        placeBid($auction_id, $bid_amount, $bid_owner);
    }
    
    Header("location: index.php");
?>