<?php

include("db/connection.php");

if (isset($_POST['delete_comment_btn'])) {
    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];

    $stmt = $con->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("location: single_post.php?post_id=" . $post_id . "&success_message=comment has been DELETED successfully");
        exit();
    } else {
        header("location: single_post.php?post_id=" . $post_id . "&error_message=can't DELETE your comment at this moment,PLZ try again later !");
        exit();
    }
} else {
    header("location:index.php");
}

?>
