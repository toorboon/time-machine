<?php
session_start();

include 'timetable.inc.php';
$object = new Timetable();
// echo 'action'.$_POST['action'].'<br>';
// echo 'start_date'.$_POST['startDate'];

if (isset($_POST['action'])){
	// if a session is already running (no stop_time in database) 
	// it will return this data for further processing
	if($_POST['action'] == 'checkSession'){
		// $resultArray[];
		$resultArray = $object->checkSession();
		echo json_encode($resultArray);	
	}

	/*if ($_POST['action'] == 'checkUser'){
		$resultArray = $object->checkUser();
		echo json_encode($resultArray);
	}*/

	// if you have no running session at all, you will start a new one with setting a start-date
	if($_POST['action'] == 'startSession'){
		$startDate = $_POST['date'];
		$result = $object->setStartDate($startDate);
		
		if ($result){
			echo 'The day has started!';
		} else {
			echo 'Your day cannot start yet!';
		}
	}
	
	// when the session should be closed, the stop date is written to the database
	if ($_POST['action'] == 'stopSession'){
		$sessionId = $_POST['sessionId'];
		$stopDate = $_POST['date'];
		$result = $object->setStopDate($stopDate, $sessionId);
		
		if ($result){
			echo 'The day is over, go home!';
		} else {
			echo 'You have to stay, your day is not over!';
		}
	}

	// when the session shall be paused, the transfered date is handled 
	// accordingly in the database
	if ($_POST['action'] == 'pauseSession'){
		$sessionId = $_POST['sessionId'];
		$pauseDate = $_POST['date'];
		$breakIndicator = filter_var($_POST['breakIndicator'],FILTER_VALIDATE_BOOLEAN);
		
		if (!$breakIndicator){
			$result = $object->setPauseStartDate($pauseDate, $sessionId);
			
			if ($result){
				echo 'Finally you have a break. Enjoy it!';
			} else {
				echo 'Oh no, something went wrong, your pause couldn\'t be registered!';
			}
		} else {
			$result = $object->setPauseEndDate($pauseDate, $sessionId);
			if ($result){
				echo 'The break is over, back to work!';
			} else {
				echo 'Oh no, something went wrong, your pause couldn\'t be stopped!';
			}
			$checkRow = $object->checkSession();
			$startBreak = new DateTime($checkRow[0]['start_break']);
			$endBreak = new DateTime($pauseDate);
			$difference = $startBreak->diff($endBreak);
			
			$duration = $difference->format('%h')*60*60*1000;
			$duration = $duration + $difference->format('%i')*60*1000;
			$duration = $duration + $difference->format('%s')*1000;
			$duration = $duration + $difference->format('%f');
			
			$object->setDuration($duration, $sessionId);
		}
	}
}