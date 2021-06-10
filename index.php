<?php
session_start();
$fanTitle = "Auktioner";
include("templates/header.php");
$expired;

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

<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- loop from here -->
        <?php
        if(isset($_GET['cat'])) {
            $cat_id = $_GET['cat'];
            $search = $_GET['search'];
            $order = $_GET['sorting'];
            $result = getCatAuctions($cat_id, $search, $order);
        } elseif(!isset($_GET['cat'])) {
            $result = getAllAuctions();
        }
        for ($i = 0; $i < count($result); $i++) {
            $auctionid = $result[$i]['auction_id'];
            if(count(getGreatestBid($auctionid))>0 && getGreatestBid($auctionid)[0]['bid_amount']>$result[$i]['min_bid']){
                $currentBid = getGreatestBid($auctionid)[0]['bid_amount'];
            } else {
                $currentBid = $result[$i]['min_bid'];
            }
            $title = $result[$i]['title'];
            $img = "img/" . $result[$i]['image'];
            $seller = getNameFromAuction($result[$i]['auction_owner'])[0]['first_name'] . " " . getNameFromAuction($result[$i]['auction_owner'])[0]['last_name'][0] . ".";
            $content = $result[$i]['description'];
            $expirationDate = $result[$i]['expiration_date'];
            $expirationDate = new DateTime($expirationDate);
            $timeNow = new DateTime();
            if($timeNow < $expirationDate){
                $expiresIn = $timeNow->diff($expirationDate);
                $expiresIn = $expiresIn->format('Udløber om %D dage, %H timer og %I minutter');
                
                include("components/product-showcase-element.php");
            } else {
                
                if(count(getGreatestBidUser($auctionid))>0){
                    if(checkIfWon($auctionid)[0]['won_by'] == null){
                        updateWinner($auctionid, getGreatestBidUser($auctionid)[0]['bid_owner']);
                    }
                }
            }
            
            
        } ?>
        <!-- to here -->
    </div>
</div>





<?php include("templates/footer.php"); ?>
