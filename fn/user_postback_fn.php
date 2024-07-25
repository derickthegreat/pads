<?php
session_start();
include_once 'user_content_fn.php';
include_once 'db_fn.php';
$dataArray = array();

if ($_POST['action'] == 'home') {
	DisplayWelcome($_SESSION['myusername']);
}elseif($_POST['action'] == 'patient'){
	DisplayPatientList();
}elseif($_POST['action'] == 'searchpatient'){
	DisplayPatientListTable(SearchPatient($_POST['lname'],$_POST['fname'],$_POST['mname']));
}elseif($_POST['action'] == 'addpatient'){
	DisplayAddPatient(0);
}elseif($_POST['action'] == 'editpatient'){
	DisplayAddPatient($_POST['dataid']);
}elseif($_POST['action'] == 'addnewpatient' || $_POST['action'] == 'updatepatient'){
	$dataArray = [$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['suffix'],$_POST['bdate'],$_POST['dataid']];
	echo json_encode(UpdatePatient($dataArray));
}elseif($_POST['action'] == 'delpatient'){
	DeletePatient($_POST['dataid']);
	DisplayPatientList();
	//echo json_encode(UpdatePatient($dataArray));
}elseif($_POST['action'] == 'viewpatient'){
	DisplayPatienEncounter($_POST['dataid']);
}elseif($_POST['action'] == 'addstatus'){
	echo json_encode(AddPatientStatus($_POST['dataid'],$_POST['isadmitted'],$_POST['userid']));
}elseif($_POST['action'] == 'addencounter'){
	DisplayAddEncounter(0,$_POST['dataid'],$_POST['userid'],$_POST['psid']);
}elseif($_POST['action'] == 'addnewencounter'){
	$dataArray = [$_POST['encounterid'],$_POST['dataid'],$_POST['psid'],$_POST['encounter'],$_POST['userid']];
	echo json_encode(UpdateEncounter($dataArray));
}else{
	echo 'none';
}
?>