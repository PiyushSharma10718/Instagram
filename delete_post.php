<?php

include("db/connection.php");

if (isset($_POST['delete_post_btn'])) {
    $post_id = $_POST['post_id'];

    $stmt = $con->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("location: profile.php?post_id=" . $post_id . "&success_message=Post has been DELETED successfully");
        exit();
    } else {
        header("location: profile.php?post_id=" . $post_id . "&error_message=can't DELETE your Post at this moment,PLZ try again later !");
        exit();
    }
} else {
    header("location:index.php");
    exit();
}

?>
