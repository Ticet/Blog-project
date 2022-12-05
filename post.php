<?php
    include 'connection.php';

    session_start();
    $userID = $_SESSION['userID'];
    

    $postName = $_POST['postName'];
    $postContent = $_POST['postContent'];
    $postTags = $_POST['postTags'];


    $query = "insert into post(user_id, name, content, date, tags) values('$userID', '$postName', '$postContent', curdate(), '$postTags')";
    $run = mysqli_query($conn, $query);
    header('Location: ../index.php');
    


    mysqli_close($conn);
?>