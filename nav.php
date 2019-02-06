<nav class="w-100 navbar navbar-expand-md bg-dark navbar-dark mt-2">
  <!-- Brand -->
  <a id="employer" class="navbar-brand" href="#"><?php echo $_SESSION['employer'];?></a>

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
        <a class="nav-link" href="#">Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reset</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="#">Change Employer</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="#">Create New User</a>
      </li> 
      <li class="nav-item">
        <a id="logout" name="logout-submit" class="nav-link" href="#">Logout</a>
        
      </li> 
    </ul>
  </div> 
</nav>