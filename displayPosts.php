<?php
    function getNumberOfPages() {
        include 'connection.php';
        $query = "select count(*) from post";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }



    function displayPosts($userID) {
        include 'connection.php';
        $query = "select * from post";
        $result = mysqli_query($conn, $query);
        $postCounter = getNumberOfPages()['count(*)'];
        $pageCounter = ceil($postCounter / 10);
        

        //check the page number from url or if if its the first page set page to 1
        if(isset($_GET['page'])) {
            $pageNum = $_GET['page'];
        }
        else {
            $pageNum = 1;
        }


        //looping trough the posts that are not on the current page
        for($i=0; $i<($pageNum-1)*10; $i++) {
            $row = mysqli_fetch_assoc($result);
        }


        //displating posts
        for($i=0; $i<10; $i++){
            $row = mysqli_fetch_assoc($result);
            if($row) {
                //query for seeing if the user already liked the post
                $isLiked = false;
                $postID = $row['post_id'];
                $likeQuery = "select * from likes where user_id = '$userID' and post_id = '$postID'";
                $likeResult = mysqli_query($conn, $likeQuery);
                $likeRow = mysqli_fetch_assoc($likeResult);
                if($likeRow) {
                    $isLiked = true;
                }

                //query for getting the username of the account that posted
                $curID = $row['user_id'];
                $uNameQuery = "select username from user where user_id = '$curID'";
                $uResult = mysqli_query($conn, $uNameQuery);
                $uNameRow = mysqli_fetch_assoc($uResult);
                ?>           


                <!--displaying the posts-->
                <center><div class="post">
                    <center> <h1 class="postH"><?php echo $row['name']?></h1> </center>
                    <center> <p class="postContent"><?php echo $row['content']?></p> </center>
                    

                    <!--Like button-->
                    <form action="scripts/likescript.php" method="post">
                        <center> <button class="likeBTN" type="submit" value="<?php echo $isLiked.' '.$row['post_id']?>" name="likeButton">
                            <!--displaying like/unlike if user liked or not-->
                            <?php
                                if($isLiked){
                                    echo 'UNLIKE';
                                }
                                else {
                                    echo 'LIKE';
                                }
                            ?>
                        </button> </center>
                    </form>

                    <!--Like count-->
                    <center> <p class="postDate"><?php echo $row['date']?> - <?php echo $uNameRow['username']?></p> </center>
                    <p class="likeCount"> Likes: <?php echo $row['likes'];?> </p>
                    
                </div></center>

            <?php
            }
        }
        ?>
        <!--page select-->
        <center><div class="pageSelect">
            <?php
            switch($pageNum) {
                //first 3 pages
                case $pageNum < 5:
                    if($pageCounter>5) {
                        for($i=1; $i<6; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }}?>
                            <a class="pageSelectNumber">...</>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $pageCounter;?>"><?php echo $pageCounter;?></a>
                            <?php
                        }
                        else {
                            for($i=1; $i<$pageCounter+1; $i++) {
                                if($i == $pageNum) {?>
                                <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                                <?php }else {?>
                                <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                                <?php
                                }}?>
                                <?php
                            }
                        break;


                //5th page               
                case $pageNum == 5: 
                    if($pageCounter > 8) {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=3; $i<$pageNum+3; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                        ?>
                        <a class="pageSelectNumber">...</>
                        <a class="pageSelectNumber" href="index.php?page=<?php echo $pageCounter;?>"><?php echo $pageCounter;?></a>
                        <?php    
                        break;
                    }
                    elseif($pageCounter == 6) {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=3; $i<7; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                        ?>
                        <?php    
                        break;
                    } 
                    elseif($pageCounter == 7) {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=3; $i<8; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                        ?>
                        <?php    
                        break;
                    } 
                    elseif($pageCounter == 8) {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=4; $i<9; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                        ?>
                        <?php    
                        break;
                    } 
                    else {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=3; $i<6; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                        ?>
                        <?php    
                        break;
                    }


                //last 3 pages
                case $pageNum > $pageCounter-4:
                    if($pageCounter > 5) {
                        ?>
                        <a class="pageSelectNumber" href="index.php?page=1">1</a>
                        <a class="pageSelectNumber">...</>
                        <?php
                        for($i=$pageCounter-4; $i<$pageCounter+1; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                    }
                    else {
                        for($i=$pageCounter-3; $i<$pageCounter+1; $i++) {
                            if($i == $pageNum) {?>
                            <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php }else {?>
                            <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                        }
                    }
                    break;
                

                
                //middle pages
                case $pageNum > 4:
                    ?>
                    <a class="pageSelectNumber" href="index.php?page=1">1</a>
                    <a class="pageSelectNumber">...</>
                    <?php
                    for($i=$pageNum-2; $i<$pageNum+3; $i++) {
                        if($i == $pageNum) {?>
                        <a class="<?php echo'curPageSelectNumber';?>" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                        <?php }else {?>
                        <a class="pageSelectNumber" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
                        <?php
                        }
                    }?>
                    <a class="pageSelectNumber">...</>
                    <a class="pageSelectNumber" href="index.php?page=<?php echo $pageCounter;?>"><?php echo $pageCounter;?></a>
                    <?php              
            }
        ?>
        </div></center>
        <?php
    }
?>