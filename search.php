<?php
    error_reporting(0);
    include 'scripts/searchtags.php';
    session_start();
    $userID = $_SESSION['userID'];

?>

<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
        

    <body>
        <div class="header">
            <!--Logo-->
            <a href="index.php"><h1 class="logo">Blog&Blog</h1></a>

            <!--Log in/out page link-->
            <?php if(!$userID) {?>
                <button class="loginBTN"><a class="loginBTNText" href="loginpage.html">Log In</a></button>
            <?php }

            else { ?>
                <button class="loginBTN"><a class="loginBTNText" href="scripts/logout.php">Log Out</a></button>
            <?php
            }
            ?>


            <!--Create a post link-->
            
            <button class="postBTN"><a class="loginBTNText" href="postpage.php">Create a post</a></button>
        </div>



        <div class="content">
            <!--Calls a funtion to display posts by tag from database-->
            <div class="posts">
                <?php displayPostsByTag($userID, 'search.php');?>
            </div>

            <!--Tags-->
            <div class="tagList">
                <p class="tag"><b>Search by tags:</b></p>
                <a class="tag" href="search.php?tag=politics"><b>Politics</b></a><br>
                <a class="tag" href="search.php?tag=art"><b>Art</b></a><br>
                <a class="tag" href="search.php?tag=crypto"><b>Crypto</b></a><br>
                <a class="tag" href="search.php?tag=coding"><b>Coding</b></a><br>
                <a class="tag" href="search.php?tag=clothing"><b>Clothing</b></a>
            </div>
        </div>


        <footer>
            <p class="footerText">Copyright © 2022 Blog&Blog. All Rights Reserved.</p>
        </footer>
    </body>

</html>
