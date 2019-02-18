<?php include("signup.modal.php");?>

<div id="lightbox" class="h-100 d-flex flex-column">     
  
    <div class="d-flex p-1 justify-content-between mb-2">
      <span>Welcome <?php echo $_SESSION['username'];?></span>
      <span id="date-element">date</span>
    </div>
  
    <div id="application">
      <!-- counter.php is rendered here (time-machine app)-->
    </div>
  
    <div class="w-100 ">
      <?php include("nav.php"); ?>
    </div>
  
  <div id="picturebox" class="h-100 bg-danger">
  </div>

</div>