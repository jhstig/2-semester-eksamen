    
<div class="col-md-3 bg-light rounded">
    <div class="row">
        <div class="col mt-3 text-center">
            <img src="img/<?php echo $img; ?>" alt="" class="img-thumbnail">
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
            <span class="font-weight-bold h3">
                <?php echo $title; ?>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col mt-2">
            <div class="font-weight-bold">
                <?php echo $description; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-2">
            <div class="font-weight-bold">
                <?php echo "Højeste bud: " . $price . "kr."; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col my-2 ">
            <div class="font-weight-bold">
                <?php echo "Udløbsdato: " . $end_time;
                if(strlen($wonBy)>0){
                    echo "<br>Vundet af: <br>".$address;
                } ?>
                
            </div>
        </div>
    </div>
</div>


