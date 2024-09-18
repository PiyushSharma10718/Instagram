<?php
session_start();
include("db/connection.php");
if (isset($_POST['comment_btn'])) {
    $user_id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['image'];
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $date = date("Y-m-d H:i:S");

    $stmt = $con->prepare("INSERT INTO comments (post_id, user_id, username, profile_image, comment_text, date) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param('iissss', $post_id, $user_id, $username, $profile_image, $comment_text, $date);

    if ($stmt->execute()) {
        header("location:single_post.php?post_id=" . $post_id . "&success_message=Comment was Submitted Successfully");
    } else {
        header("location:single_post.php?post_id=" . $post_id . "&error_message=Couldn't Submit your Comment, Something went wrong try again !");
    }
    exit();
} else {
    header("location:index.php");
    exit();
}
