<?php include("includes/header.php"); ?>


<?php

include("db/connection.php");

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $stmt = $con->prepare('SELECT * FROM posts WHERE id = ?');
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $post_array = $stmt->get_result();
} else {
    header("location: index.php");
    exit();
}

?>


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

    <?php foreach ($post_array as $post) { ?>

        <div class="camera">
            <div class="camera-image">
                <?php if (isset($_GET['image_name'])) { ?>
                    <img style="width: 500px;" src="<?php echo "Assets/Images/" . $_GET['image_name']; ?>" alt="" />
                <?php } else { ?>
                    <img style="width: 500px;" src="<?php echo "Assets/Images/" . $post['image']; ?>" alt="" />
                <?php } ?>

                <form action="update_post.php" method="post" enctype="multipart/form-data" class="camera-form">
                    <div class="form-group">
                        <input type="file" name="new_image" class="form-control" required>
                        <input type="hidden" name="old_image_name" value="<?php echo $post['image']; ?>">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="caption" class="form-control" placeholder="type captions..."
                            value="<?php echo $post['caption']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="hashtags" class="form-control" placeholder="type hashtags..."
                            value="<?php echo $post['hashtags']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update_post_btn" class="upload-btn" style="width: 100%;">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>