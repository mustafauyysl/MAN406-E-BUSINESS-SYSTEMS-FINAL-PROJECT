<?php
ob_start();
session_start();

include "connection.php";

// Register

if (isset($_POST['register'])) {

    $user_name = htmlspecialchars($_POST['user_name']);
    $user_surname = htmlspecialchars($_POST['user_surname']);
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_password = htmlspecialchars($_POST['user_password']);
    $user_authority = htmlspecialchars($_POST['user_authority']);
    $captcha = $_POST['captcha'];
    $entered_captcha = $_POST['entered_captcha'];

    if ($captcha == $entered_captcha) {

        $isExistUser = $db->prepare("SELECT * FROM users WHERE user_email=:mail");
        $isExistUser->execute(array(
            'mail' => $user_email
        ));

        $count = $isExistUser->rowCount();

        if ($count == 0) {
            $password = md5($user_password);

            $saveUser = $db->prepare("INSERT INTO users SET
            user_name=:user_name,
            user_surname=:user_surname,
            user_email=:user_email,
            user_password=:user_password,
            user_authority=:user_authority
        ");
            $insert = $saveUser->execute(array(
                'user_name' => $user_name,
                'user_surname' => $user_surname,
                'user_email' => $user_email,
                'user_password' => $password,
                'user_authority' => $user_authority
            ));

            if ($insert) {
                $_SESSION['user_email'] = $user_email;
                if($user_authority == 0) {
                    header("Location:../home.php");
                }else {
                    header("Location:../products.php");
                }
            } else {
                header("Location:../register.php?register=error");
            }
        } else {
            header("Location:../register.php?register=exist_user");
        }
    } else {
        header("Location:../register.php?captcha=error");
    }
}

// Login

if (isset($_POST['login'])) {
    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']);
    $captcha = $_POST['captcha'];
    $entered_captcha = $_POST['entered_captcha'];

    if ($captcha == $entered_captcha) {
        $isExistUser = $db->prepare("SELECT * FROM users WHERE user_email=:user_email and user_password=:user_password and user_authority=:user_authority");
        $isExistUser->execute(array(
            'user_email' => $user_email,
            'user_password' => $user_password,
            'user_authority' => 0
        ));

        $count = $isExistUser->rowCount();

        if ($count == 1) {
            $_SESSION['user_email'] = $user_email;
            header("Location:../home.php");
            exit;
        } else {
            header("Location:../login.php?login=error");
        }
    } else {
        header("Location:../login.php?captcha=error");
    }
}

// Admin Login

if (isset($_POST['adminLogin'])) {
    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']);
    $captcha = $_POST['captcha'];
    $entered_captcha = $_POST['entered_captcha'];

    if ($captcha == $entered_captcha) {
        $isExistUser = $db->prepare("SELECT * FROM users WHERE user_email=:user_email and user_password=:user_password and user_authority=:user_authority");
        $isExistUser->execute(array(
            'user_email' => $user_email,
            'user_password' => $user_password,
            'user_authority' => 1
        ));

        $count = $isExistUser->rowCount();

        if ($count == 1) {
            $_SESSION['user_email'] = $user_email;
            header("Location:../products.php");
            exit;
        } else {
            header("Location:../login.php?admin=yes&login=error");
        }
    } else {
        header("Location:../login.php?admin=yes&captcha=error");
    }
}

// Add to Cart

if (isset($_POST['addToCart'])) {

    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    if ($_SESSION['cart'][$title]) {
        $_SESSION['cart'][$title]['quantity'] += 1;
    } else {
        $product = array(
            "product_title" => $title,
            "product_price" => $price,
            "quantity" => $quantity
        );

        $_SESSION['cart'][$title] = $product;
    }

    header("Location:../home.php");
}

// Remove From Cart

if (isset($_POST['removeFromCart'])) {

    $title = $_POST['product_title'];

    unset($_SESSION['cart'][$title]);

    header("Location:../home.php");
}

// Delete Product

if ($_GET['delete'] == "ok") {

    $delete = $db->prepare("DELETE from products where product_id=:product_id");
    $control = $delete->execute(array(
        'product_id' => $_GET['id']
    ));

    if ($control) {
        Header("Location:../products.php?delete=ok");
    } else {

        Header("Location:../products.php?delete=no");
    }
}

// Update Product

if (isset($_POST['updateProduct'])) {

    $save = $db->prepare("UPDATE products SET
        product_img=:product_img,
        category_id=:category_id,
		product_title=:product_title,
		product_price=:product_price,
		product_weight=:product_weight
		WHERE product_id={$_POST['product_id']}");
    $update = $save->execute(array(
        'product_img' => htmlspecialchars($_POST['product_img']),
        'category_id' => htmlspecialchars($_POST['category_id']),
        'product_title' => htmlspecialchars($_POST['product_title']),
        'product_price' => htmlspecialchars($_POST['product_price']),
        'product_weight' => htmlspecialchars($_POST['product_weight'])
    ));

    if ($update) {

        Header("Location:../products.php?update=ok");
    } else {

        Header("Location:../products.php?update=no");
    }
}

// Add Products

if (isset($_POST['addProduct'])) {

    $addProduct = $db->prepare("INSERT INTO products SET
        product_img=:product_img,
        category_id=:category_id,
		product_title=:product_title,
		product_price=:product_price,
		product_weight=:product_weight
		");

    $insert = $addProduct->execute(array(
        'product_img' => htmlspecialchars($_POST['product_img']),
        'category_id' => htmlspecialchars($_POST['category_id']),
        'product_title' => htmlspecialchars($_POST['product_title']),
        'product_price' => htmlspecialchars($_POST['product_price']),
        'product_weight' => htmlspecialchars($_POST['product_weight'])
    ));

    if ($insert) {

        Header("Location:../products.php?add=ok");
    } else {

        Header("Location:../products.php?add=no");
    }
}

// Complete Order

if (isset($_POST['completeOrder'])) {

    $addProduct = $db->prepare("INSERT INTO orders SET
        user_email=:user_email,
        order_price=:order_price
		");

    $insert = $addProduct->execute(array(
        'user_email' => $_SESSION['user_email'],
        'order_price' => $_POST['order_price']
    ));

    if ($insert) {
        unset($_SESSION['cart']);
        Header("Location:../home.php?order=ok");
    } else {

        Header("Location:../home.php?order=no");
    }
}

// Update Order Status

if (isset($_POST['updateOrderStatus'])) {

    $save = $db->prepare("UPDATE orders SET
		order_status=:order_status
		WHERE order_id={$_POST['order_id']}");
    $update = $save->execute(array(
        'order_status' => $_POST['order_status']
    ));

    if ($update) {

        Header("Location:../orders.php?update=ok");
    } else {

        Header("Location:../orders.php?update=no");
    }
}
