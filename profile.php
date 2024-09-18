<?php include("includes/header.php"); ?>

<header class="profile-header">
    <div class="profile-container">





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





        <div class="profile">
            <div class="profile-image">
                <img src="<?php echo "Assets/Images/" . $_SESSION['image']; ?>" alt="">
            </div>
            <div class="profile-user-settings">
                <h1 class="profile-user-name"><?php echo $_SESSION['username']; ?></h1>

                <form action="edit_profile.php" method="get" style="display: inline-block;">
                    <button class="profile-btn profile-edit-btn">Edit Profile</button>
                </form>





                <button class="profile-btn profile-settings-btn" id="options_btn" aria-label="profile settings">
                    <!-- <span class="material-symbols-outlined">
                        settings
                    </span> -->
                    <i class="fas fa-cog"></i>
                </button>


                <div class="popup" id="popup">
                    <div class="popup-window">
                        <span class="close-popup" id="close-popup">&times;</span>
                        <a href="edit_profile.php">Edit Profile</a>
                        <a href="camera.php">Create Post</a>
                        <a href="logout.php">Log out</a>
                    </div>
                </div>


            </div>
            <div class="profile-stats">
                <ul>
                    <li>
                        <span class="profile-stat-count">
                            <?php echo $_SESSION['post']; ?>
                        </span> posts
                    </li>

                    <form action="my_followers.php" method="post" style="display: inline-block;">
                        <li>
                            <span class="profile-stat-count">
                                <?php echo $_SESSION['followers']; ?>
                            </span>
                            <input type="submit" value="followers" style="background: none; border: none;">
                        </li>
                    </form>

                    <form action="my_following.php" method="post" style="display: inline-block;">
                        <li>
                            <span class="profile-stat-count">
                                <?php echo $_SESSION['following']; ?>
                            </span>
                            <input type="submit" value="following" style="background: none; border: none;">
                        </li>
                    </form>

                </ul>
            </div>
            <div class="profile-bio">
                <p><span class="profile-real-name"><?php echo $_SESSION['username'] . ", "; ?></span> <?php echo $_SESSION['bio']; ?></p>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="profile-container">
        <div class="gallery">

            <?php include("get_user_post.php"); ?>

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


<script>
    var popupWindow = document.getElementById('popup');
    var optionsBtn = document.getElementById('options_btn');
    var closeWindow = document.getElementById('close-popup');

    optionsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        popupWindow.style.display = 'block';
    })

    closeWindow.addEventListener('click', (e) => {
        e.preventDefault();
        popupWindow.style.display = 'none';
    })

    closeWindow.addEventListener('click', (e) => {
        if (e.target == popupWindow) {
            popupWindow.style.display = 'none';
        }
    })
</script>


</body>

</html>