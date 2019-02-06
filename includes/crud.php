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
}