<?php
include_once 'user_content_fn.php';
include_once 'db_fn.php';
$dataArray = array();

if ($_POST['action'] == 'home') {
	DisplayHome('Derick');
}else{
	echo "none";
}
?>