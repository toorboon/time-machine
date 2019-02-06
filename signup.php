<main>
	<div class='modal <?php if (!(isset($_GET['error']))){echo "fade";} ?>' id="signup_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Sign up!</h5>
			 		<button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
		      		   <span aria-hidden="true">&times;</span>
		       		</button>
	      		</div>

		 		<?php 
		 		$name = '';
		 		$email = '';
		 		$category = 'user';

		 		if (isset($_GET['error'])){
		 			echo "<script>
		 						$(document).ready(function(){
	  								$('#signup_user').modal('show')
	  							});
	  					  </script>";
		 			if ($_GET['error'] == "emptyfields") {
		 				echo "<p class='mx-auto mt-2 text-danger'>Fill in all fields!</p>";
		 				if (isset($_GET['uid'])){
		 					$name = $_GET['uid'];
		 				}
		 				if (isset($_GET['mail'])){
		 					$email = $_GET['mail'];
		 				}
		 				$category = $_GET['cat'];

		 			} else if ($_GET['error'] == "invalidmailuid"){
		 				echo "<p class='mx-auto mt-2 text-danger'>E-Mail and Username was wrong!</p>";	

		 			} else if ($_GET['error'] == "invaliduid"){
		 				echo "<p class='mx-auto mt-2 text-danger'>Invalid Username!</p>";
		 				if (isset($_GET['mail'])){
		 					$email = $_GET['mail'];
		 				}
		 				$category = $_GET['cat'];

		 			} else if ($_GET['error'] == "invalidmail"){
		 				echo "<p class='mx-auto mt-2 text-danger'>Invalid E-Mail</p>";
		 				if (isset($_GET['uid'])){
		 					$name = $_GET['uid'];
		 				}
		 				$category = $_GET['cat'];

		 			} else if ($_GET['error'] == "passwordcheck"){
		 				echo "<p class='mx-auto mt-2 text-danger'>Your passwords do not match!</p>";
		 				if (isset($_GET['uid'])){
		 					$name = $_GET['uid'];
		 				}
		 				if (isset($_GET['mail'])){
		 					$email = $_GET['mail'];
		 				}
		 				$category = $_GET['cat'];

		 			} else if ($_GET['error'] == "usertaken"){
		 				echo "<p class='mx-auto mt-2 text-danger'>Username is already taken!</p>";
		 				if (isset($_GET['mail'])){
		 					$email = $_GET['mail']; 
		 				}
		 				$category = $_GET['cat'];
		 			}
		 		} else if (isset($_GET['signup'])){
		 			if ($_GET['signup'] == "success"){
		 			echo '<script>swal("Well Done!", "You sucessfully signed up!", "success");</script>';
		 			}
		 		}

		 		?>

	 		<div class="modal-body">
	 			<form class="form" action="includes/signup.inc.php" method="post" accept-charset="utf-8">
		 			<div class="form-group">
		 				<input class="form-control" type="text" name="uid" placeholder="Username" value="<?php if($name){echo "$name";} ?>">
		 			</div>
		 			<div class="form-group">
		 				<input class="form-control" type="text" name="mail" placeholder="E-Mail" value="<?php if($email){echo "$email";} ?>">
		 			</div>
		 			<div class="form-group">
		 				<input class="form-control" type="password" name="pwd" placeholder="Password">
		 			</div>
		 			<div class="form-group">
		 				<input class="form-control" type="password" name="pwd-repeat" placeholder="Repeat Password">
		 			</div>
		 			<div class="form-group">
		 				<select class="custom-select form-control" name="category">
		 					<option value="user">User</option>
		 					<option value="admin" <?php if($category == 'admin'){echo 'selected';} ?>>Admin</option>
		 				</select>
		 			</div>
		 			<div class="d-flex justify-content-center btn-group">
						<button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
						<button  class="btn btn-success" type="submit" name="signup-submit">Sign Up</button>
					</div>
	 			</form>
	 		</div>
	 	</div>
	 </div>
</main>
