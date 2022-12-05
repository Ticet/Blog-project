<?php
    include 'connection.php';

    $uname = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accExists = false;


    $query = "select * from user where username = '$uname' and email='$email' and password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    //checks if account alredy exists
    if($row['username'] == $uname and $row['email'] = $email and $row['password'] = $password) {
        $accExists = true;
    }

    
    //adds user to database
    if(!$accExists) {
        $query = "insert into user(username, email, password) values('$uname', '$email', '$password')";
       mysqli_query($conn, $query);
    }
    else {
        echo 'Account already exists';
    }

    //starting session
    if(!$accExists) {
        $query = "select user_id from user where password = '$password' and username='$uname' and email='$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['userID'] = $row['userID'];
        header('Location: ../index.php');
    }
    


    mysqli_close($conn);
?>