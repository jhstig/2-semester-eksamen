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

function getCity($zip) {
  global $conn;
  $sql = "SELECT city_name FROM zip_codes WHERE zip_code = '$zip'";
  $city = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $city[] = $row;
    }
  }
  return $city;

}

function insertaddresses($streetname, $streetname2, $housenumber, $zipcode, $firstname, $lastname, $password, $email, $phonenumber){
  global $conn;
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO adresses (address_id, street_name, street_name2, house_number, zip_code)
  VALUES (null, '$streetname', '$streetname2', '$housenumber', '$zipcode')";

  $result = mysqli_query($conn, $sql);
  $lastid = mysqli_insert_id($conn);

  $sql = "INSERT INTO users (user_id, first_name, last_name, password, email, phone_number, address_id)
  VALUES (null, '$firstname', '$lastname', '$hashedPassword', '$email', '$phonenumber','$lastid')";

  $result = mysqli_query($conn, $sql);

}
function getPasswordByEmail($email){
  global $conn;
  $sql = "SELECT password FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  $password = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $password[] = $row;
    }
  }
  return $password;
}
function getUserIdByEmail($email){
  global $conn;
  $sql = "SELECT user_id FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  $userid = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $userid[] = $row;
    }
  }
  return $userid;
}