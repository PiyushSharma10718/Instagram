<?php include("includes/header.php"); ?>

<?php

include("db/connection.php");

if (isset($_GET['comment_id']) && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $comment_id = $_GET['comment_id'];
    $stmt = $con->prepare('SELECT * FROM comments WHERE id = ?');
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $comment_array = $stmt->get_result();
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


    <?php foreach ($comment_array as $comment) { ?>

        <div class="camera">
            <div class="camera-image">

                <form action="update_comment.php" method="post" class="camera-form">
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="comment_text" class="form-control" value="<?php echo $comment['comment_text']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update_comment_btn" class="upload-btn" style="width: 100%;">
                            Update Comment
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