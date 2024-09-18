<?php

session_start();    

include("../db/connection.php");

if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $con->prepare("SELECT id, username, email, image, followers, following, post, bio FROM users WHERE email = ? AND password = ?");

    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();

    $stmt->store_result();

    // same email and password already exists !
    if($stmt->num_rows() > 0){
        $stmt->bind_result($id, $username, $email, $image, $followers, $following, $post, $bio);
        $stmt->fetch();

        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['image'] = $image;
        $_SESSION['followers'] = $followers;
        $_SESSION['following'] = $following;
        $_SESSION['post'] = $post;
        $_SESSION['bio'] = $bio;

        header("location: ../index.php");


    }else{
        header("location: ../login.php?error_message=Email/Password Incorrect");
        exit();
    }


}else{

    header("location: ../login.php?error_message=Error occured, try again later !");

}



?>
