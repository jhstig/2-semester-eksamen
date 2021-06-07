<?php
session_start();
include("templates/header.php");
include("templates/profile-header.php");
?>
<div class="container">
<div class="row justify-content-center">
      <div class="col-md-6">
        <form action="create.php" method="post" class="mt-4" >
            <div class="form-group h3 text-center">
                Opret en auktion
            </div>
            <div class="form-group">
                <input name="title" type="text" class="form-control" placeholder="Titel på produkt" required>
            </div>
            <div class="form-group">
                <input name="description" type="text" class="form-control" placeholder="Beskrivelse (maks 300 tegn)" required>
            </div>
            
            <div class="form-group">
              <input name="image" type="text" class="form-control" placeholder="billede (tbc)" required>
            </div>
            <div class="form-group">
              <input name="min_price" type="number" class="form-control" placeholder="Minimum pris" required>
            </div>
            <div class="form-group">
              <input name="expiration_date" type="datetime-local" class="form-control" placeholder="Udløbstidspunkt" required>
            </div>
            <div class="form-group">
                <select class="custom-select" name="cat" value="Vælg en kategori" id="inlineFormCustomSelectPref">
                    
                    
                    <?php
                    $categories = getAllCats();
                    foreach($categories as $x => $val) { ?>
                        <option value="<?php echo getAllCats()[$x]['category_id']; ?>"><?php echo getAllCats()[$x]['category_name']; ?>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block">Opret auktion</button>
            </div>
        </form>
      </div>
    </div>
</div>








<?php
include("templates/footer.php");
?>