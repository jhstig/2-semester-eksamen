<?php
$conn;

function connect() { //connect to DB
    global $conn; //set var to global
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS); //mysqli_connect(host,user,pw)
    if(!$conn) { //if not connected then kill (test if error)
        die(mysqli_error($conn));   //kill
    }
    mysqli_select_db($conn, DBNAME); //select DB that's to be used
}
function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function getAllAuctions() {
  global $conn;
  $sql = 'SELECT auction_id, title, description, image, auction_owner, min_bid, expiration_date, category_id FROM auctions';
  $result = mysqli_query($conn, $sql);
  $product_list = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $product_list[] = $row;
    }
  }
  return $product_list;
}

function getNameFromAuction($id) {
  global $conn;
  $sql = 'SELECT users.first_name, users.last_name
  FROM users
  INNER JOIN auctions
  ON users.user_id = auctions.auction_owner
  WHERE users.user_id = "'.$id.'"';

  $result = mysqli_query($conn, $sql);
  $userid = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $userid[] = $row;
    }
  }
  return $userid;

}

function getGreatestBid($auction) {
  global $conn;
  $sql = "SELECT bids_list.bid_amount
    FROM bids_list
    INNER JOIN auctions
    ON auctions.auction_id = bids_list.auction_id
    WHERE auctions.auction_id = '$auction'
    ORDER BY bids_list.bid_amount DESC";

  $result = mysqli_query($conn, $sql);
  $bids = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $bids[] = $row;
    }
  }
  return $bids;
}
