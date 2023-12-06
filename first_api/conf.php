<?php

$conn= mysqli_connect("localhost","root","","first_api");

if(!$conn){

die("Could not connect to db" . mysqli_connect_error());
}
