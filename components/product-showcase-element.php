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
            Auktionen udløber om 
            <?php
                if($expiresIn/60/60 >= 24) {
                    echo round($expiresIn/60/60/24) . " dage";
                } elseif($expiresIn/60/60 >= 1) {
                    echo round($expiresIn/60/60) . " timer";
                } elseif($expiresIn/60 >= 1) {
                    round($expiresIn/60) . " minutter";
                } else {
                    echo "Auktionen er udløbet";
                    $expired = 1;
                }
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
                        <form action="index.php" type="post" class="form-group">
                            <div class="form-group row justify-content-around">
                                <label for="userBid" class="col-1 col-form-label">kr.</label>
                                <input class="col-10 form-control" type="number" name="amount" id="userBid" placeholder="Afgiv et bud" value="<?php echo $currentBid+5; ?>" required>
                            </div>
                            <div class="form-group form-check text-center">
                                <input class="form-check-input" type="checkbox" value="" id="confirmBid<?php echo $i; ?>" required>
                                <label class="form-check-label" for="confirmBid<?php echo $i; ?>">Mit bud er bindende</label>
                            </div>
                            <button type="submit" class="btn-block btn btn-primary <?php if($expired){echo "disabled";}?>" <?php if($expired){echo "disabled";}?>>Afgiv bud</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>