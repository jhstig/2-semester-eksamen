<?php
session_start();
include("templates/header.php");

$amountLamps = 0;
$amountTables = 0;
$amountChairs = 0;
$currentTime = $_SERVER['REQUEST_TIME'];
if(isset($_GET['search']) && isset($_GET['cat']) && isset($_GET['sorting'])){
    if($_GET['search'] == ""){
        echo "du har ikke søgt efter noget <br> ";
        echo "Du har søgt efter kategorien: " . $_GET['cat'];
    } else {
        echo "Søgefelt: " . $_GET['search'];
        echo "<br>";
        echo "Kategorifelt: " . $_GET['cat'];
    }
}
$categories = getAllCats();
?>

<div class="container-fluid mt-5">
    <form action="index.php" method="get" class="form-group">
        <div class="form-row justify-content-center">
            <div class="col-md-2 form-group">
                <select class="custom-select" name="cat" id="inlineFormCustomSelectPref">
                    <option selected value="all">Alle varer</span></option>
                    <?php foreach($categories as $x => $val) {
                      $selected = "";
                      if($_GET['cat'] == getAllCats()[$x]['category_id']){
                        $selected = "selected";
                      } ?>
                        <option <?php echo $selected; ?> value="<?php echo getAllCats()[$x]['category_id']; ?>"><?php echo getAllCats()[$x]['category_name']; ?> (<?php echo countAmountByCategory(getAllCats()[$x]['category_id'])[0]['COUNT(category_id)'] ?>)</option>
                    <?php } ?>
                    <!--<option value="expired">Udløbne auktioner</option>-->
                </select>
            </div>
            <div class="col-md-5 form-group">
                <div class="input-group">
                    <input type="search" name="search" class="form-control rounded" placeholder="Søg">
                </div>
            </div>
            <div class="col-md-1 form-group">
                <select class="custom-select" name="sorting" id="inlineFormCustomSelectPref">
                    <option value="ASC">Billigste først</option>
                    <option value="DESC">Dyreste først</option>
                </select>
            </div>
            <div class="col-1 form-group">
                <button type="submit" class="btn btn-block ml-2 btn-info">Søg</button>
            </div>
        </div>
    </form>
</div>
<?php //echo date('Y-m-d H:i:s'); ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- loop from here -->
        <?php
        if(isset($_GET['cat'])) {
          $cat_id = $_GET['cat'];
          $search = $_GET['search'];
          $order = $_GET['sorting'];

          $result=getCatAuctions($cat_id, $search, $order);
          for ($i = 0; $i < count($result); $i++) {
              $auctionid = $result[$i]['auction_id'];
              if(count(getGreatestBid($auctionid))>0){
                  $currentBid = getGreatestBid($auctionid)[0]['bid_amount'];
              } else {
                  $currentBid = $result[$i]['min_bid'];
              }
              $title = $result[$i]['title'];
              $img = "img/" . $result[$i]['image'];
              $seller = getNameFromAuction($result[$i]['auction_owner'])[0]['first_name'] . " " . getNameFromAuction(getAllAuctions()[$i]['auction_owner'])[0]['last_name'][0] . ".";
              $content = $result[$i]['description'];
              $expirationDate = $result[$i]['expiration_date']; //1 week from now
              //$expirationDate = (new $expirationDate)->getTimestamp();
              $expiresIn = $expirationDate - time();

              include("components/product-showcase-element.php");
          }
        } elseif(!isset($_GET['cat'])) {
            for ($i = 0; $i < count(getAllAuctions()); $i++) {
                $auctionid = getAllAuctions()[$i]['auction_id'];
                if(count(getGreatestBid($auctionid))>0){
                    $currentBid = getGreatestBid($auctionid)[0]['bid_amount'];
                } else {
                    $currentBid = getAllAuctions()[$i]['min_bid'];
                }
                $title = getAllAuctions()[$i]['title'];
                $img = "img/" . getAllAuctions()[$i]['image'];
                $seller = getNameFromAuction(getAllAuctions()[$i]['auction_owner'])[0]['first_name'] . " " . getNameFromAuction(getAllAuctions()[$i]['auction_owner'])[0]['last_name'][0] . ".";
                $content = getAllAuctions()[$i]['description'];
                $expirationDate = getAllAuctions()[$i]['expiration_date'];
                $expiresIn = strtotime($expirationDate)-strtotime(date("now"));
                
                include("components/product-showcase-element.php");
            }
        }

        ?>
        <!-- to here -->
    </div>
</div>





<?php include("templates/footer.php"); ?>
