<?php 
echo ('in signup.inc.php');
if(isset($_POST['signup-submit'])){

	//connect the database
	include("dbconnect.inc.php");

	$connection = $connection ?? null;
	if ($connection){
		$conn = $connection->connectDBprocedural();
	} else {
		$connection = new Database();
		$conn = $connection->connectDBprocedural();
	} 

	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	$category = $_POST['category'];

	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
		header("Location: ../index.php?error=emptyfields&uid=".$username."&mail=".$email."&cat=".$category);
		exit(); //stops the script vom executing!

	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../index.php?error=invalidmailuid");
		exit();

	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../index.php?error=invalidmail&uid=".$username."&cat=".$category);
		exit();

	} else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../index.php?error=invaliduid&mail=".$email."&cat=".$category);
		exit();

	} else if ($password !== $passwordRepeat) {
		header("Location: ../index.php?error=passwordcheck&uid=".$username."&mail=".$email."&cat=".$category);
		exit();

	} else {
		$sql = "SELECT username FROM users WHERE username=?"; //placeholder for executing safe queries
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: ../index.php?error=usertaken&mail=".$email."&cat=".$category);
			exit();
			} else {
				$sql = "INSERT INTO users (username, email, password,role) VALUES (?,?,?,?)"; //Placeholders put for safer inserts
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../index.php?error=sqlerror");
					exit();
				} else {
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $category);
					mysqli_stmt_execute($stmt);
					header("Location: ../index.php?signup=success");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../index.php");
	exit();
}