<?php
include('table/tables.php');
include('commonConditions.php');

 //$conn = mysqli_connect("localhost", "id11244791_fabiz", "fabiz", "id11244791_fabiz");
 $conn = mysqli_connect("localhost", "root", "", "fabiz");
 if (!$conn) {
     mysqli_error();
     die();
 }

$response = array();
$response["success"] = false;
$response["status"] = "INVALID";
