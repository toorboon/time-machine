<?php
session_start();

include 'timetable.inc.php';
$object = new Timetable();
// echo 'action'.$_POST['action'].'<br>';
// echo 'start_date'.$_POST['startDate'];

if (isset($_POST['action'])){
	if($_POST['action'] == 'insertStartDate'){
		$startDate = $_POST['startDate'];
		$result = $object->setStartDate($startDate);
		// echo $startDate;
		echo $result;
	}
	if($_POST['checkDatabase']){
		$resultArray[];
		$resultArray = $object->checkDatabase();
		print_r($resultArray);
	}
	//Therefore I first need to fetch the rowId!
	/*if ($_POST['action'] == 'insertStopDate'){
		$rowId = $_POST['rowId'];
		$stopDate = $_POST['stopDate'];
		$result = $object->setStopDate($stopDate);
		
		echo $result;
	}*/
}