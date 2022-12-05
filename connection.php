<?php
    $conn = mysqli_connect('localhost', 'root', '', 'db1');
    if(!$conn) {
        die('Connection failed! Error:'.mysqli_connect_error());
    }

?>