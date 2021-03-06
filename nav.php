<nav class="w-100 navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a id="time-machine" class="navbar-brand" href="#">Time-Machine</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Export</a>
      </li>
      <li class="nav-item">
        <a id="overview" class="nav-link" href="#">Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reset</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="#">Change Employer</a>
      </li> 
      <?php if (isset($_SESSION['admin'])){?>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#signup_user" href="#">Create New User</a>
        </li> 
      <?php } ?>
      <li class="nav-item">
        <!-- This will be a list where you can save the items you want to buy in grocery stores. Also think about making it cross user available. -->
        <a class="nav-link" href="#">Grocery-list</a>
      </li> 
      <li class="nav-item">
        <a id="logout" name="logout-submit" class="nav-link" href="#">Logout</a>
        
      </li> 
    </ul>
  </div> 
</nav>