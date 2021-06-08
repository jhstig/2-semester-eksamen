<div class="row">
    <div class="col-2">
        <img src="img/<?php echo $img; ?>" alt="" class=" img-thumbnail">
    </div>
    <div class="col-4">
      <div class="row">
        <div class="col font-weight-bold">
          <?php echo $title ?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <?php echo $description ?>
        </div>
      </div>
    </div>
    <div class="col-2">
      <?php echo "Du har budt " . $price . " kr" ?>
    </div>
    <div class="col-2">
      <?php echo $status ?>
    </div>
    <div class="col-2">
      <?php echo $end_time?>
    </div>
  </div>
  <hr>