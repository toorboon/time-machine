<?php

include "dbconnect.inc.php";

class Timetable extends Database{

	public function checkSession($sessionId = null){
		$userId = $_SESSION['user_id'];
		$sql = "SELECT * FROM timetable 
				WHERE (end_time IS NULL OR end_time = '') 
					AND user_id = ".$userId.";";
		$result = $this->connectDB()->query($sql);
		// return $sql;
		$numRows = $result->num_rows;
		
		switch ($numRows){
			case 0:
				return $data[] = array('error'=>true, 'message'=>'No session started yet!');
				break;

			case 1:
				$data = $result->fetch_all(MYSQLI_ASSOC);
				return $data;
				break;

			default:
				return $data[] = array('error'=>true, 'message'=>'Two sessions started! You can only have one active session!');
		}
	}

	public function checkUser(){
		$userId = $_SESSION['user_id'];
		$sql = "SELECT * FROM users 
				WHERE user_id = ".$userId.";";
	}

	public function setStartDate($startDate){
		$userId = $_SESSION['user_id'];
		// echo $userId;
		$sql = "INSERT INTO timetable (user_id, start_time) VALUES ('".$userId."','".$startDate."');";
		// echo $sql;
		$result = $this->connectDB()->query($sql);
		return $result;
	}

	public function setStopDate($stopDate, $sessionId){
		$sql = "UPDATE timetable SET end_time = '".$stopDate."' WHERE id = ".$sessionId.";";
		$result = $this->connectDB()->query($sql);
		return $result;
	}
	
	public function setPauseStartDate($pauseStartDate, $sessionId){
		$sql = "UPDATE timetable SET start_break = '".$pauseStartDate."', end_break = NULL WHERE id = ".$sessionId.";"; 
		$result = $this->connectDB()->query($sql);
		return $result;
	}

	public function setPauseEndDate($pauseEndDate, $sessionId){
		$sql = "UPDATE timetable SET end_break = '".$pauseEndDate."' WHERE id = ".$sessionId.";"; 
		$result = $this->connectDB()->query($sql);
		return $result;
	}

	public function setDuration($duration, $sessionId){
		$sql = "UPDATE timetable SET duration_break = '".$duration."' WHERE id = ".$sessionId.";"; 
		$result = $this->connectDB()->query($sql);
		return $result;
	}
}

