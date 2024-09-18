<?php

session_start();

include("db/connection.php");

if (isset($_POST['update_profile_btn'])) {
    $user_id = $_SESSION['id'];
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $image = $_FILES['image']['tmp_name']; //FILE

    if ($image != "") {
        $image_name = $username . ".jpg";
    } else {
        $image_name = $_SESSION['image'];
    }

    if ($username != $_SESSION['username']) {
        // make sure the user is unique !
        $stmt = $con->prepare("SELECT username FROM users WHERE username = ?");

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->store_result();

        // is the user with the same name exists !

        if ($stmt->num_rows() > 0) {
            header("location:edit_profile.php?error_message=Username was Already taken");
            exit();
        } else {
            updateUserProfile($con, $username, $bio, $image_name, $user_id, $image);
        }
    } else {
        updateUserProfile($con, $username, $bio, $image_name, $user_id, $image);
    }
} else {
    header("location:edit_profile.php?error_message=Something went wrong, Try Again Later !");
    exit();
}

// 

function updateUserProfile($con, $username, $bio, $image_name, $user_id, $image)
{
    $stmt = $con->prepare("UPDATE users SET username = ?, bio = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $bio, $image_name, $user_id);

    if ($stmt->execute()) {
        if ($image != "") {
            // Storing the image in the Folder !
            move_uploaded_file($image, "Assets/Images/" . $image_name);
        }

        // update_session
        $_SESSION['username'] = $username;
        $_SESSION['bio'] = $bio;
        $_SESSION['image'] = $image_name;

        updateProfileImageAndUserNameInPostTable($username, $con, $image_name, $user_id);
        updateProfileImageAndUserNameInCommentsTable($username, $con, $image_name, $user_id);

        header("location:profile.php?success_message=Profile has been updated successfully !");
        exit();
    } else {
        header("location: edit_profile.php?error_message=Something Went Wrong, Try Again Later !");
        exit();
    }
}


function updateProfileImageAndUserNameInCommentsTable($username, $con, $image_name, $user_id){
    $stmt = $con->prepare("UPDATE comments SET username = ?, profile_image= ? WHERE user_id = ?");
    $stmt->bind_param("ssi",$username, $image_name, $user_id);
    $stmt->execute();
}

function updateProfileImageAndUserNameInPostTable($username, $con, $image_name, $user_id){
    $stmt = $con->prepare("UPDATE posts SET username = ?, profile_image= ? WHERE user_id = ?");
    $stmt->bind_param("ssi",$username, $image_name, $user_id);
    $stmt->execute();
}



