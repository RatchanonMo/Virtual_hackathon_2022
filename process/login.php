<?php
session_start();
include('../connect/connect.php');

if (isset($_POST['submit'])) {
    $username =   $_POST['username'];
    $password =  $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username'  ";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 1) {
        $_SESSION['username'] = '1';
        $_SESSION['logged_in'] = '1';

            header('location: ../manage.php ');
    } else {

        header('location: ../index.php?error=1');
    }
}