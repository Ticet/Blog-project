<?php
    function displayPostsByTag() {
        include 'connection.php';

        $tag = $_GET['tag'];
     
        ?>
        
        <center><h1 class="tagH">#<?php echo $tag?></h1></center>

        <?php
        //query for getting posts which countion the tag
        $query = "select * from post where tags like '%$tag%'";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)){
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


            <center><div class="post">
                <center> <h1 class="postH"><?php echo $row['name']?></h1> </center>
                <center> <p class="postContent"><?php echo $row['content']?></p> </center>
                

                <!--Like button-->
                <form action="scripts/likescript.php" method="post">
                    <center> <button type="submit" value="<?php echo $isLiked.' '.$row['post_id']?>" name="likeButton">
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