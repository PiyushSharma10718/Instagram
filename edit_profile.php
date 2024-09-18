<?php include("includes/header.php"); ?>

<!-- SECTION -->
<section class="main">
    <div class="wrapper">
        <div class="left-col">
            <h3>Update Profile</h3>
            <?php if (isset($_GET['error_message'])) {
            ?>
                <p class="text-center alert-danger">
                    <?php echo $_GET['error_message'] ?>
                </p>
            <?php
            }
            ?>
            <form action="update_profile.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <img src="<?php echo "Assets/Images/" . $_SESSION['image']; ?>" class="edit-profile-image" alt="">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>

                    <input type="text" class="form-control" name="email" id="email" placeholder="email">

                    <!-- <p class="form-control">Email</p> -->
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="username"
                        value="<?php echo $_SESSION['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" id="bio" class="form-control" cols="30" rows="3"> <?php echo $_SESSION['bio']; ?> </textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" name="update_profile_btn" id="update_profile_btn" class="update-profile-btn" value="update" type="button" />
                </div>
            </form>
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