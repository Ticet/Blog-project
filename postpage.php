<?php
    error_reporting(0);
    session_start();
    $userID = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>


    <body>
    <!--header-->    
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
            
            <button class="postBTN"><a class="loginBTNText" href="postpage.html">Create a post</a></button>
        </div>


        <center><h1 class="postCreateH">Create a Post</h1></center>
        

        <!--Post creating form-->
        <center><div class="postFormDiv">
            <center><form class="postForm" action="scripts/post.php" method="post">
                <p class="postText">Name</p>
                <input class="postInputName" type="text" name="postName">
                <br>

                <p class="postText">Content</p>
                <textarea class="postInputContent" name="postContent"></textarea>
                <br>

                <p class="postText">Tags</p>
                <textarea class="postInputTags" name="postTags"></textarea>
                <br>

                <?php
                //redirects to login page if not logged in(also doesnt allow to even access the page if not logged in)
                if($userID) { ?>
                    <button  class="postCreateBTN" type="submit">Create</button>
                <?php }else { ?>             
                    <button class="postCreateBTN" onclick="<?php header('Location: loginpage.html')?>">Create</button>
                <?php } ?>
            </form></center>
        </div></center>


        <!--footer-->
        <footer>
            <p class="footerText">Copyright © 2022 Blog&Blog. All Rights Reserved.</p>
        </footer>

    </body>

</html>