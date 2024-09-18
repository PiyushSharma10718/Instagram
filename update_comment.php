<?php

include("db/connection.php");

if (isset($_POST['update_comment_btn'])) {
    $comment_id = $_POST['comment_id'];
    $comment_text = $_POST['comment_text'];
    $post_id = $_POST['post_id'];

    $stmt = $con->prepare("UPDATE comments SET comment_text = ? WHERE id = ?");
    $stmt->bind_param("si", $comment_text, $comment_id);

    if ($stmt->execute()) {
        header("location: single_post.php?post_id=" . $post_id . "&success_message=comment has been updated successfully");
        exit();
    } else {
        header("location: single_post.php?post_id=" . $post_id . "&error_message=can't update your comment at this moment try again later !");
        exit();
    }
} else {
    header("location:index.php?error_message?error occured, try again later !");
}

?>
