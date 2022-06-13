<?php
session_start();
include('../connect/connect.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];


    

    $delete = "DELETE FROM billboard WHERE id = '$id' ";
    $query = mysqli_query($conn, $delete);



    $_SESSION['success'] = "delete";

    header('location: ../manage.php');
}