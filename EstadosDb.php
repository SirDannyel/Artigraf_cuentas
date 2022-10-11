<?php

require_once('database.php');  

//$Mayor = $_POST['Mayor'];
	

$Estados  = EjecutaSQL("Select Estado", "Select Estado from Dim_Estado order by 1 ");

writeServerLog($Estados);
 

?>