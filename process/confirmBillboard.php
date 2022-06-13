<?php
session_start();
include('../connect/connect.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $province = $_POST['province'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $type = $_POST['type'];
    $height = $_POST['height'];
    $width = $_POST['width'];

  
    $date = date("Y-m-d");


    $sql = "UPDATE billboard SET name = '$name', province = '$province', lat = '$lat', lng = '$lng', type = '$type', height = '$height', width = '$width', status = 'checked', date = '$date' WHERE id = '$id' ";
    $query = mysqli_query($conn, $sql);

    



    $_SESSION['success'] = "add";

    header('location: ../manage.php');
}
