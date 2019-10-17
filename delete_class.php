<?php
 require_once('database.php');
 $id = $_GET['id'];
 
 $res = $database->delete_class($id);
 if($res){
 	header('location: class.php');
 }else{
 	echo "Failed to Delete Record";
 }
?>