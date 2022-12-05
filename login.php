<?php
    error_reporting(0);
    include 'connection.php';

    $uname = $_POST['username'];
    $password = $_POST['password'];
    $unameExists = false;


    //check if username exists in database
    $query = "select username from user";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        if($row['username'] == $uname) {
            $unameExists = true;
            break;
        }
        else {
            $unameExists = false;
        }
    }

    //prints if uname doesnt exists
    if(!$unameExists) {
        echo "Username doesn't exist";
    }


    //checks if the password is correct
    if($unameExists) {
        $query = "select password, user_id from user where username = '$uname'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if($row['password'] == $password) {
            echo 'Logged in';
            session_start();
            $_SESSION['userID'] = $row['user_id'];
            header('Location: ../index.php');
        }
        else {
            echo 'Incorrect Password';
        }
    }


    mysqli_close($conn);
?>