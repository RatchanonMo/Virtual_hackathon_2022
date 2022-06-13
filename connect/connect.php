
<?php 
    $conn = mysqli_connect('localhost','root','','billboard');

    if(!$conn){
        die("Connection failed". mysqli_connect_error());
    }

    $conn->set_charset('UTF8')
?>