<?php

session_start();

include("db/connection.php");

if (isset($_POST['upload_image-btn'])) {
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['image'];
    $caption = $_POST['caption'];
    $hashtags = $_POST['hashtags'];
    $image = $_FILES['image']['tmp_name']; //file
    $likes = 0;
    $date = date("Y-m-d H:i:s");

    $image_name = strval(time()) . ".jpg"; //1234567890.jpg
    // create post 

    $stmt = $con->prepare("INSERT INTO posts (user_id, likes, image, caption, hashtags, date, username, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssss", $id, $likes, $image_name, $caption, $hashtags, $date, $username, $profile_image);
    if ($stmt->execute()) {
        // store image in folder
        move_uploaded_file($image, "Assets/Images/" . $image_name);

        // increase the no. of posts
        $stmt = $con->prepare("UPDATE users SET post=post+1 WHERE id = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $_SESSION['post'] = $_SESSION['post'] + 1;
        header("location: camera.php?success_message=Post has been Created Successfully&image_name=" . $image_name);
        exit();
    } else {
        header("location: camera.php?error_message=Something went wrong, Try Again Later");
        exit();
    }
} else {
    header("location: camera.php?error_message=Something went wrong ");
}
