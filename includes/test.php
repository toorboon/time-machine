<?php
	require("dbconnect.inc.php");

	$conn = $db_obj->connectDB();

	$test_sql = 'select * from user;';

	$return = mysqli_query($conn, $test_sql);

	$result = $return->fetch_all(MYSQLI_ASSOC);
	if (mysqli_num_rows($return) > 0) {
		echo json_encode($result);
	}else{
		echo 'No stuff in Database!';
	}
