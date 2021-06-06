<?php include("templates/header.php");

echo $_SESSION['user'];


$amountLamps = 4;
$amountTables = 3;
$amountChairs = 6;
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
?>
<div class="container-fluid mt-5">
    <form action="index.php" method="get" class="form-group">
        <div class="form-row justify-content-center">
            <div class="col-md-2 form-group">
                <select class="custom-select" name="cat" id="inlineFormCustomSelectPref">
                    <option selected value="all">Alle varer</span></option>
                    <option value="chairs">Stole (<?php echo $amountChairs ?>)</option>
                    <option value="lamps">Lamper (<?php echo $amountLamps ?>)</option>
                    <option value="tables">Borde (<?php echo $amountTables ?>)</option>
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
                    <option selected value="expiration_min">Udløber snart</span></option>
                    <option value="created_max">Nyeste først</option>
                    <option value="price_max">Dyreste først</option>
                    <option value="price_min">Billigste først</option>

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
        <?php echo count(getAllAuctions());
            for ($i = 0; $i < count(getAllAuctions()); $i++) {
                $auctionid = getAllAuctions()[$i]['auction_id'];
                $currentBid;
                if(count(getGreatestBid($auctionid))>0){
                  $currentBid = getGreatestBid($auctionid)[0]['bid_amount'];
                } else {
                  $currentBid = getAllAuctions()[$i]['min_bid'];
                }
                $title = getAllAuctions()[$i]['title'];
                $img = "img/" . getAllAuctions()[$i]['image'];
                $seller = getNameFromAuction(getAllAuctions()[$i]['auction_owner'])[0]['first_name'] . " " . getNameFromAuction(getAllAuctions()[$i]['auction_owner'])[0]['last_name'][0] . ".";
                $content = getAllAuctions()[$i]['description'];
                $expirationDate = getAllAuctions()[$i]['expiration_date']; //1 week from now
                $expiresIn = $expirationDate - time();

                include("components/product-showcase-element.php");
            }

        ?>

        <!-- to here -->
    </div>
</div>





<?php include("templates/footer.php"); ?>
