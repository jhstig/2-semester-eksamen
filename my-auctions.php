<?php
session_start();
include("templates/header.php");
include("templates/profile-header.php");
?>
<div class="container-fluid">
  <h5 class="text-center font-weight-bold bg-light">Mine auktioner</h5>
    <div class="col mt-3">


  </div>
</div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-3 bg-light rounded">
        <div class="row">
          <div class="col mt-3 text-center">
            <img src="img/placeholder.png" alt="" class="img-thumbnail">
          </div>
        </div>
        <div class="row">
          <div class="col mt-3">
            <span class="font-weight-bold h3">
              Titel
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col mt-2">
            <div class="font-weight-bold">
            Beskrivelse
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col mt-2">
            <div class="font-weight-bold">
            Pris
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col my-2 ">
            <div class="font-weight-bold">
            Udløbsdato
            </div>
          </div>
        </div>

    </div>
  </div>


<hr>

 <div class="container-fluid">
   <h5 class="text-center font-weight-bold bg-warning">Vundne aktioner</h5>
     <div class="col mt-3">


     </div>
    </div>
  </div>

  <div class="container bg-light pt-4 rounded">
    <div class="row">
      <div class="col-6">
        <div class="font-weight-bold">
        Senest vundne
        </div>
      </div>
      <div class="col-2">
        <div class="font-weight-bold">
        Pris
      </div>
      </div>
      <div class="col">
        <div class="font-weight-bold">
        Vundet/Budt
      </div>
      </div>
      <div class="col-2">
        <div class="font-weight-bold">
        Lukket tidspunkt
      </div>
      </div>
      <div class="col-2">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-2">
        Billede
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col">
            Titel
          </div>
        </div>
        <div class="row">
          <div class="col">
            Beskrivelse
          </div>
        </div>
      </div>
      <div class="col-2">
        Pris
      </div>
      <div class="col-2">
        Vundet/budt
      </div>
      <div class="col-2">
        Dato
      </div>
    </div>
  </div>









<?php
include("templates/footer.php");
?>
