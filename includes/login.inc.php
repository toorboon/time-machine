<?php 
session_start();
	if (!(isset($_SESSION['user_id']))){
		header("Location: ../index.php");
	}	

if (isset($_POST['login-submit'])) {
	
	//connect the database
	include("dbconnect.inc.php");

	$connection = $connection ?? null;
	if ($connection){
		$conn = $connection->connectDBprocedural();
	} else {
		$connection = new Database();
		$conn = $connection->connectDBprocedural();
	}

	$email = $_POST['email'];
	$password = $_POST['pwd'];

	if (empty($email) || empty($password)){
		header("Location: ../index.php?error=emptyfields");
		exit();
	
	} else {
		$sql = "SELECT * FROM users WHERE username=? OR email=?;"; //again uses prepared statemens
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror&uid=".$email);
			exit();

		} else {
			mysqli_stmt_bind_param($stmt, "ss", $email, $email); //I don't understand that! Why two times the same?
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($password, $row['password']);
				if ($pwdCheck == false) {
					header("Location: ../index.php?error=wrongpwd&uid=".$email);
					exit();

				} else if ($pwdCheck == true) {
					session_start();
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['username'] = ucwords($row['username']);
					$_SESSION['employer'] = $row['employer'];
					if ($row['role'] == 'admin'){
						$_SESSION['admin'] = 1;
					}
					header("Location: ../index.php?login=success");
					exit();

				} else {
					header("Location: ../index.php?error=wrongpwd&uid=".$email);
					exit();
				}
				
			} else {
				header("Location: ../index.php?error=nouser");
				exit();
			}
		}
	}

} else {
	header("Location: ../index.php");
	exit();
}

