<?php include("includes/header.php"); ?>

<!-- SELECTION -->
<section class="main">
    <div class="wrapper">
        <div class="left-col">

            <?php if (isset($_GET['success_message'])) { ?>
                <p class="text-center alert alert-success">
                    <?php echo $_GET['success_message'] ?>
                </p>
            <?php } ?>

            <?php if (isset($_GET['error_message'])) { ?>
                <p class="text-center alert alert-danger">
                    <?php echo $_GET['error_message'] ?>
                </p>
            <?php } ?>

            <!--STATUS-->

            <?php include("get_status_wrapper.php"); ?>

            <!-- POST -->

            <?php include("get_latest_post.php"); ?>

            <?php foreach ($posts as $post) { ?>

                <div class="post">
                    <div class="info">
                        <div class="user">
                            <div class="profile-pic">
                                <img src="<?php echo "Assets/Images/" . $post['profile_image']; ?>" alt="Sorry but the POST is unavailable !">
                            </div>
                            <p class="username"><?php echo $post['username']; ?></p>
                        </div>
                        <a href="single_post.php?post_id=<?php echo $post['id']; ?>" style="color: #000;">
                            <i class="fas fa-ellipsis-h options"></i>
                        </a>
                    </div>
                    <img src="<?php echo "Assets/Images/" . $post['image']; ?>" class="post-image" alt="This is my First post that will be available soon..." />

                    <!-- post reaction buttons comment and like ! -->

                    <div class="post-content">
                        <div class="reaction-wrapper">

                            <?php include("check_if_user_like_this_post.php") ?>

                            <?php if ($user_like_this_post) { ?>

                                <form action="unlike_this_post.php" method="post">
                                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                    <button type="submit" class="heart" style="color: #fe4164;" name="heart_btn">
                                        <i class="icon fas fa-heart"></i>
                                    </button>
                                </form>

                            <?php } else { ?>

                                <form action="like_this_post.php" method="post">
                                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                    <button type="submit" class="heart" name="heart_btn">
                                        <i class="icon fas fa-heart"></i>
                                    </button>
                                </form>

                            <?php } ?>

                            <i class="icon fas fa-comment"></i>
                        </div>
                        <p class="like"><?php echo $post['likes']; ?></p>
                        <p class="descriiption"><span><?php echo $post['caption']; ?></span><?php echo $post['hashtags']; ?></p>
                        <p class="post-time"><?php echo date("M, Y.", strtotime($post['date'])); ?></p>
                    </div>

                    <div>
                        <a href="single_post.php?post_id=<?php echo $post['id']; ?>" class="btn">comments</a>
                    </div>

                    <!-- <div class="comment-wrapper">
                        <img src="Assets/Images/profile.jpg" class="icon">
                        <input type="text" class="comment-box" placeholder="Add a Comment">
                        <button class="comment-btn">Post</button>
                    </div> -->

                </div>
            <?php } ?>

            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page_no <= 1) {
                                                echo 'disabled';
                                            } ?>">
                        <a class="page-link" href="
                        <?php if ($page_no <= 1) {
                            echo '#';
                        } else {
                            echo '?page_no=' . ($page_no - 1);
                        } ?>" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="?page_no=3">3</a></li>

                    <?php if ($page_no > 3) { ?>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"></a>
                        </li>
                    <?php } ?>

                    <li class="page-item<?php if ($page_no >= $total_no_of_pages) {
                                            echo 'disabled';
                                        } ?>">
                        <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                                        echo '#';
                                                    } else {
                                                        echo '?page_no=' . ($page_no + 1);
                                                    } ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="right-col">

            <!-- Profile-Card -->

            <?php include("profile_card.php"); ?>

            <!-- Suggestion-card -->

            <?php include("suggestion_side_area.php"); ?>

        </div>
    </div>
</section>

<!-- SCRIPT -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"> </script>
</body>

</html>