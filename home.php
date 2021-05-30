<?php
ob_start();
session_start();
include "./settings/connection.php";
$askCategories = $db->prepare("SELECT * FROM categories");
$askCategories->execute();

if ($_GET['category']) {
    $askProducts = $db->prepare("SELECT * FROM products WHERE category_id=:category_id");
    $askProducts->execute(array(
        'category_id' => $_GET['category']
    ));
} else {
    $askProducts = $db->prepare("SELECT * FROM products");
    $askProducts->execute();
}

$query = $db->prepare("SELECT * FROM users where user_email=:user_email");
$query->execute(array(
    'user_email' => $_SESSION['user_email']
));
$isUser = $query->rowCount();
$getUser = $query->fetch(PDO::FETCH_ASSOC);
if ($isUser == 0) {
    Header("Location:login.php");
    exit;
}

?>
<?php require_once "header.php"; ?>

<div class="container-fluid px-5">
    <div class="row mt-5">
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="home.php" class="category_title">
                        All
                    </a>
                </li>
                <?php
                while ($getCategories = $askCategories->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <li class="list-group-item">
                        <a href="home.php?category=<?php echo $getCategories['category_id']; ?>" class="category_title">
                            <?php echo $getCategories['category_title']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-7">
            <div class="row">
                <?php
                while ($getProducts = $askProducts->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="col-3 mb-3">
                        <div class="card text-center">
                            <img src="<?php echo $getProducts['product_img']; ?>" class="card-img-top" alt="<?php echo $getProducts['product_title']; ?>" />
                            <div class="card-body">
                                <h5 class="card-title">₺ <?php echo $getProducts['product_price']; ?></h5>
                                <p class="card-text"><?php echo $getProducts['product_title']; ?></p>
                                <p class="card-text"><?php echo $getProducts['product_weight']; ?> gr</p>
                            </div>
                            <form action="./settings/operations.php" method="POST">
                                <input type="hidden" name="product_title" value="<?php echo $getProducts['product_title']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $getProducts['product_price']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button class="add-button" type="submit" name="addToCart">
                                    <i class="fas fa-plus" style="color:#4c3398;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-3 w-100 h-100 bg-white py-3">
            <h4 class="text-center mb-2">Cart</h4>
            <hr>
            <?php

            if ($_SESSION['cart']) { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Quantity</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $product) { ?>

                            <tr>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['product_title']; ?></td>
                                <td>
                                    <form action="./settings/operations.php" method="POST">
                                        <input type="hidden" name="product_title" value="<?php echo $product['product_title']; ?>">
                                        <button type="submit" name="removeFromCart" class="btn btn-danger">x</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $product) {
                    $total = $total + ($product['quantity'] * $product['product_price']);
                }
                ?>
                <div>
                    <p class="display: flex; text-right"> = Total: <?php echo $total; ?> ₺</p>
                    <hr>
                </div>
                <form action="./settings/operations.php" method="POST">
                    <input type="hidden" name="order_price" value="<?php echo $total; ?>">
                    <button type="submit" name="completeOrder" class="btn btn-primary w-100" style="background-color: rgba(76, 51, 152, 1); border-color:rgba(76, 51, 152, 1);">Complete Order</button>
                </form>
            <?php } else { ?>
                <div class="text-center">
                    <i class="fas fa-shopping-cart fa-5x" style="color: rgba(76, 51, 152, 0.3);"></i>
                    <p class="mt-3">Cart is Empty</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>