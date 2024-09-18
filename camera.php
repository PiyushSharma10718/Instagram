<?php include("includes/header.php"); ?>

<div class="camera-container">

    <?php if (isset($_GET['success_message'])) { ?>
        <p class="text-center mt-4 alert alert-success">
            <?php echo $_GET['success_message'] ?>
        </p>
    <?php } ?>

    <?php if (isset($_GET['error_message'])) { ?>
        <p class="text-center mt-4 alert alert-danger">
            <?php echo $_GET['error_message'] ?>
        </p>
    <?php } ?>


    <div class="camera">
        <div class="camera-image">
            <?php if (isset($_GET['image_name'])) { ?>
                <img style="width: 500px;" src="<?php echo "Assets/Images/" . $_GET['image_name']; ?>" alt="" />
            <?php } else { ?>
                <img style="width: 500px;" src="Assets/Images/2 (1).jpg" alt="" />
            <?php } ?>

            <form action="create_post.php" method="post" enctype="multipart/form-data" class="camera-form">
                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="caption" class="form-control" placeholder="type captions..." required>
                </div>
                <div class="form-group">
                    <input type="text" name="hashtags" class="form-control" placeholder="type hashtags..." required>
                </div>
                <div class="form-group">
                    <button type="submit" name="upload_image-btn" class="upload-btn">
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>