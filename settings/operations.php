<?php 
ob_start();
session_start();

include "connection.php";

// Register

if(isset($_POST['register'])) {

    $user_name = htmlspecialchars($_POST['user_name']);
    $user_surname = htmlspecialchars($_POST['user_surname']);
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_password = htmlspecialchars($_POST['user_password']);

    $isExistUser=$db->prepare("SELECT * FROM users WHERE user_email=:mail");
    $isExistUser->execute(array(
        'mail' => $user_email
    ));

    $count=$isExistUser->rowCount();

    if($count==0) {
        $password =md5($user_password);

        $saveUser=$db->prepare("INSERT INTO users SET
            user_name=:user_name,
            user_surname=:user_surname,
            user_email=:user_email,
            user_password=:user_password
        ");
        $insert=$saveUser->execute(array(
            'user_name' => $user_name,
            'user_surname' => $user_surname,
            'user_email' => $user_email,
            'user_password' => $password
        ));

        if($insert) {
            $_SESSION['user_email'] = $user_email;
            header("Location:../home.php");
        }else {
            header("Location:../register.php?register=error");
        }
    } else {
        header("Location:../register.php?register=exist_user");
    }

}

// Login

if(isset($_POST['login'])) { 
    $user_email=$_POST['user_email'];
    $user_password=md5($_POST['user_password']);
    
    $isExistUser=$db->prepare("SELECT * FROM users WHERE user_email=:user_email and user_password=:user_password");
    $isExistUser->execute(array(
        'user_email' => $user_email,
        'user_password' => $user_password
    ));

    $count=$isExistUser->rowCount();

    if($count==1) {
        $_SESSION['user_email'] = $user_email;
        header("Location:../home.php");
        exit;
    }else {
        header("Location:../login.php?login=error");
    }


}
