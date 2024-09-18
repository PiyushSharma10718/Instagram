<?php include("includes/header.php"); ?>

<?php

include("db/connection.php");

if (isset($_POST['other_user_id'])) {
    $other_user_id = $_POST['other_user_id'];
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
    $stmt->bind_param("i", $other_user_id);

    if ($stmt->execute()) {
        $user_array = $stmt->get_result();
    } else {
        header("location:index.php");
    }
} else {
    header("location:index.php");
    exit();
}

?>

<header class="profile-header">
    <div class="profile-container">

        <?php foreach ($user_array as $user) { ?>

            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo "Assets/Images/" . $user['image']; ?>" alt="">
                </div>

                <div class="profile-user-settings" style="width: 35%;text-align: center">
                    <h1 class="profile-user-name"><?php echo $user['username']; ?></h1>
                </div>

                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count"><?php echo $user['post']; ?></span> posts</li>
                        <li><span class="profile-stat-count"><?php echo $user['followers']; ?> </span> followers</li>
                        <li><span class="profile-stat-count"><?php echo $user['following']; ?></span> following</li>
                    </ul>

                    <?php include('check_follow_status.php'); ?>

                    <?php if ($following_status) { ?>

                        <form action="unfollow_this_person.php" method="post">
                            <input type="hidden" name="other_user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="follow-btn-user-profile" name="unfollow_btn">
                                Unfollow
                            </button>
                        </form>
                    <?php } else { ?>

                        <form action="follow_this_person.php" method="post">
                            <input type="hidden" name="other_user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="follow-btn-user-profile" name="follow_btn">
                                Follow
                            </button>
                        </form>
                    <?php } ?>

                </div>
                <div class="profile-bio" style="text-align: center; width: 100%">
                    <p style="text-align: center"><span class="profile-real-name"><?php echo $user['username'] . ", "; ?></span> <?php echo $user['bio']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</header>

<main>
    <div class="profile-container">
        <div class="gallery">

            <?php include("get_other_post.php"); ?>

            <?php foreach ($posts as $post) { ?>

                <div class="gallery-item">
                    <img src="<?php echo "Assets/Images/" . $post['image']; ?>" class="gallery-image" alt="">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes">
                                <span class="hide-gallery-element"><?php echo $post['likes']; ?></span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments">
                                <span class="hide-gallery-element">Comments:</span>
                                <i class="fas fa-comment"></i>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</main>


<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/  dist/js/bootstrap.min.js"> </script>

</body>

</html>