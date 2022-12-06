<?php
    include 'connection.php';
    session_start();
    $userID = $_SESSION['userID'];
    $postIDArray = explode(' ', $_POST['likeButton']);
    $postID = $postIDArray[1];
    $pageName = $postIDArray[2];


    echo $postIDArray[0];

    //reading from the button value if user liked the post and setting a varible for it
    if($postIDArray[0] == '1') {
        $isLiked = true;
    }
    else {
        $isLiked = false;
    }


    $query = "insert into likes(user_id, post_id) values('$userID', $postID)";
    $unlikeQuery = "delete from likes where user_id = '$userID' and post_id = '$postID'";

    //making querys for updating likes column on post table
    $addLikesQuery = "update post set likes = likes + 1 where post_id = '$postID'";
    $removeLikesQuery = "update post set likes = likes -1 where post_id = '$postID'";


    if(!$isLiked) {
        if(!$userID) {
            header("Location: ../loginpage.html");
        }
        else {
            mysqli_query($conn, $query);
            mysqli_query($conn, $addLikesQuery);
            header("Location: ../$pageName");
        }
    }
    else {
        mysqli_query($conn, $unlikeQuery);
        mysqli_query($conn, $removeLikesQuery);
        header("Location: ../$pageName");
    }

?>