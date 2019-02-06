
<div class="">     
  <div class="d-flex justify-content-between">
    <span>Welcome <?php echo $_SESSION['first_name'];?></span>
    <span id="date-element">date</span>
  </div>
   
  <div class="d-flex justify-content-around">
    <div id="counter" class="w-25 bg-primary">
    infofield
    </div>
    <div class="btn-group-vertical">  
      <button id="start_button" class="btn btn-success" type="button">Start</button>
      <button id="stop_button" class="btn btn-danger" type="button">Stop</button>
      <button class="btn btn-secondary" type="button">Break</button>
      
    </div>
    <div id='results' class="w-25 bg-primary">
    infofield
    </div>
  </div>

  <div class="w-100 d-flex justify-content-between">
    <?php include("nav.php"); ?>
  </div>
</div>