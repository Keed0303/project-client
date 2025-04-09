<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "db_crud";

$conn = new mysqli($servername, $username, $password, $databasename);

if(!$conn) {
  die("connected");
}