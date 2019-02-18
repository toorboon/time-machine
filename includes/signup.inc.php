<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	//connect the database
	include("dbconnect.inc.php");

	$connection = $connection ?? null;
	if ($connection){
		$conn = $connection->connectDBprocedural();
	} else {
		$connection = new Database();
		$conn = $connection->connectDBprocedural();
	} 

	$username = strip_tags(trim($_POST['uid']));
	$username = str_replace(array("\r","\n"),array(" "," "),$username);
	$email = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
	$password = strip_tags(trim($_POST['pwd']));
	$passwordRepeat = strip_tags(trim($_POST['pwd-repeat']));
	$employer = strip_tags(trim($_POST['employer']));
	$userRole = $_POST['user_role'];

	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
		echo 'Fill in all fields!';
		exit(); //stops the script vom executing!

	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		echo 'E-Mail and Username was wrong!';
		exit();

	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Invalid E-Mail!';
		exit();

	} else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		echo 'Invalid Username!';
		exit();

	} else if ($password !== $passwordRepeat) {
		echo 'Your passwords do not match!';
		exit();

	} else {
		$stmt = mysqli_stmt_init($conn);
		$checkUser = checkAttribute($conn, $stmt, 'username' ,$username);
		$checkEmail = checkAttribute($conn, $stmt, 'email', $email);
		
		if (!$checkUser || !$checkEmail){
			exit();
		} else {
			$sql = "INSERT INTO users (username, email, password, role, employer) VALUES (?,?,?,?,?)"; //Placeholders put for safer inserts
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo 'SQL Error';
				exit();
			} else {
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashedPwd, $userRole, $employer);
				mysqli_stmt_execute($stmt);
				echo 'You sucessfully signed up!';
				exit();
			}
		}
	}//ends here
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	echo 'Nothing to do!';
	exit();
}

function checkAttribute($conn, $stmt, $field, $attribute){
	$sql = "SELECT ".$field." FROM users WHERE ".$field."=?"; //placeholder for executing safe queries
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo 'field: '.$field;
		echo 'attribute: '.$attribute;
		echo 'sql: '.$sql;
		echo 'SQL Error';
		return false;
	} else {
		mysqli_stmt_bind_param($stmt, "s", $attribute);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		
		if ($resultCheck > 0) {
			echo $attribute.' is already taken!<br>';
			return false;
		} else {
			return true;
		}
	} 
}