<?php
$expired = 0;

?>
<div class="col-md-3 m-4 border rounded" style="background-color:white;">
    <div class="row">
        <div class="col text-center mt-3">
            <span class="font-weight-bold h3"><?php echo $title; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $content; ?>
        </div>
    </div>
    <div class="row">
        <div class="col text-center mt-2">
            <img src="<?php echo $img; ?>" alt="" class=" img-thumbnail">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col text-center">
            Sælger: <span><?php echo $seller; ?></span>
            <br>
            Udløber om
            <?php
                echo $expiresIn;
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col text-center my-2">
                    <span class="mb-2">
                        Bud: <?php echo $currentBid; ?> kr.

                    </span>
                </div>
            </div>
            <?php if($_SESSION['user'] != null) {?>
                <div class="row">
                    <div class="col">
                        <form action="bid.php" method="POST" class="form-group">
                            <input name="auctionid" type="hidden" value="<?php echo $auctionid;?>">
                            <div class="form-group row justify-content-around">
                                <label for="userBid" class="col-1 col-form-label">kr.</label>
                                <input class="col-10 form-control" type="number" name="formBid" id="userBid" placeholder="Afgiv et bud" value="<?php echo $currentBid+1; ?>" required>
                            </div>
                            <div class="form-group form-check text-center">
                                <input class="form-check-input" type="checkbox" id="<?php echo $auctionid; ?>" required>
                                <label class="form-check-label" for="<?php echo $auctionid; ?>">Mit bud er bindende</label>
                            </div>
                            <button type="submit" name="formBtn" class="btn-block btn btn-primary <?php if($expired){echo "disabled";}?>" <?php if($expired){echo "disabled";}?>>Afgiv bud</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
