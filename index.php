<?php session_start(); ?>

    <?php {include("head.php");} ?>
    <title>Time-Machine</title>
  </head>

  <body>
    
    <?php if (isset($_SESSION['user_id'])) {include("main.php");} ?>
    

    <?php 
      if (!(isset($_SESSION['user_id']))) { 
    ?>
      <div class="d-flex flex-column align-items-center mt-5">
        <div class="container">
          <div class="jumbotron text-center text-dark">
            <h1 class="display-4">Welcome to the <br> Time-Machine!</h1>
            <p class="lead">This is a simple web application, where you can handle your served time at work!</p>
            <hr>
            <p>Test me with these login credentials!</p>
            <div>
              <span>login: horst</span><br>
              <span>pw: test</span>
          </div>
        </div>
      </div>
    <div class="navbar fixed-top navbar-dark bg-dark">
      <div class="d-flex">
      <?php 
        $login = '';
        
        if (isset($_GET['error'])){
          if ($_GET['error'] == 'emptyfields'){
            echo "<p class='text-danger my-auto'>Please enter a username and password!</p>";
          } else if ($_GET['error'] == "sqlerror") {
            echo "<p class='text-danger my-auto'>SQL Error!</p>";
            if (isset($_GET['uid'])){
              $login = $_GET['uid'];
            }
          } else if ($_GET['error'] == "wrongpwd"){
            echo "<p class='text-danger  my-auto'>Password is wrong!</p>";  
            if (isset($_GET['uid'])){
              $login = $_GET['uid'];
            }
          } else if ($_GET['error'] == "nouser"){
            echo "<p class='text-danger my-auto'>There is no user with this username!</p>";
          }
        }
      ?>
    </div>
      <form class="d-flex form-inline" action="includes/login.inc.php" method="POST" accept-charset="utf-8">
        <input class="mx-1" type="text" name="email" placeholder="Username/E-Mail..." value="<?php if($login){echo $login;} ?>">
        <input class="mx-1" type="password" name="pwd" placeholder="Password...">
        <button class="btn btn-outline-success mx-1" type="submit" name="login-submit">Login</button>
      </form>
    </div>
    <?php
      }
    ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="ext_ressources/popper/popper.js"></script>
    <script src="ext_ressources/bootstrap/js/bootstrap.min.js"></script>
    <?php if (isset($_SESSION['user_id'])) { ?>
      <script src="js/main.js" type="text/javascript" charset="utf-8" async defer></script>
    <?php } if (isset($_SESSION['admin'])){ ?>
      <script src="js/signup.js" type="text/javascript" charset="utf-8" async defer></script>
    <?php } ?>
  </body>
</html>