<?php
session_start();
include("templates/header.php");
include("templates/profile-header.php");
if($_SESSION['user'] == ""){
  header("Location: index.php");
  exit();
}
$message ="";
if(isset($_FILES['image'])) {
  $errors= array();
  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];

  if(empty($errors)==true){
     move_uploaded_file($file_tmp,"img/".$file_name);
  }else{
     print_r($errors);
  }
}

if (isset($_POST['auction-btn'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $image = $file_name;
  $min_bid = $_POST['min_price'];
  $expiration_date = $_POST['expiration_date'];
  $category_id = $_POST['cat'];
  $auctionOwner = $_SESSION['user'];


  if(strlen($description)>300){
    $message = "Din beskrivelse er for lang. Gør den lidt kortere";
  } elseif(strlen($title)>50) {
    $message = "Din titel er for lang. Gør den lidt kortere";
  } else {
    insertauction($title, $description, $image, $min_bid, $expiration_date, $category_id, $auctionOwner);
    $message = "Din auktion er blevet oprettet!";
  }

}
?>
<div class="container">
<div class="row justify-content-center">
      <div class="col-md-6">
        <form action="create.php" method="post" class="mt-4" enctype="multipart/form-data">
            <div class="form-group h3 text-center">
                <span class='ikea-yellow-text'><?php echo $message; ?></span><br>
                Opret en auktion
            </div>
            <div class="form-group">
                <input name="title" type="text" class="form-control" placeholder="Titel på produkt" required>
            </div>
            <div class="form-group">
                <input name="description" type="text" class="form-control" placeholder="Beskrivelse (maks 300 tegn)" required>
            </div>

            <div class="form-group">
              <input name="image" type="file" class="form-control" id="image" required>
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
            <div class="form-group text-center h3">
                <button name="auction-btn" type="submit" class="btn btn-block">Opret auktion</button>
            </div>
        </form>
      </div>
    </div>
</div>








<?php
include("templates/footer.php");
?>
