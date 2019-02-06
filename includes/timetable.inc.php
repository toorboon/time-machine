<?php

include "dbconnect.inc.php";

class Timetable extends Database{

	public function setStartDate($startDate){
		$userId = $_SESSION['user_id'];
		// echo $userId;
		$sql = "INSERT INTO timetable (user_id, start_time) VALUES ('".$userId."','".$startDate."');";
		// echo $sql;
		$result = $this->connectDB()->query($sql);
		
		return $result;
	}

	/*public function setStopDate($stopDate){
		$userId = $_SESSION['user_id'];
		$sql = "UPDATE timetable SET end_date WHERE  (user_id, start, processing) VALUES ('".$userId."','".$startDate."','1')";
		$result = $this->connectDB()->query($sql);
		return $result;
	}*/
		
}

//INSERT INTO `time-machine`.`timetable` (`user_id`, `start`, `processing`) VALUES ('1', '2019-02-02', '1');
