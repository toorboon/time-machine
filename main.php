
<div id="lightbox" class="h-100 d-flex flex-column">     
  <div id="" class="">
  <div class="d-flex p-1 justify-content-between">
    <span>Welcome <?php echo $_SESSION['first_name'];?></span>
    <span id="date-element">date</span>
  </div>
   
  
  <div class="">
    <div id="infobox" class="bg-dark  p-2 text-white" data-test="<?php echo $_SESSION['employer'];?>">
    </div>
    <div id="counter_box" class="mt-2  p-2 bg-dark text-center green_text">
    </div>
  </div>
  
  
  <div class="w-100 btn-group p-2">  
      <button id="start_button" class="w-100 btn btn-success" type="button">Start</button>
      <button id="stop_button" class="w-100 btn btn-danger" type="button">Stop</button>
      <button id="break_button" class="w-100 btn btn-secondary" type="button">Break</button>
  </div>
  </div>
  
  <div class="w-100 ">
    <?php include("nav.php"); ?>
  </div>
  
  <div id="picturebox" class="h-100 bg-danger">
  </div>

</div>