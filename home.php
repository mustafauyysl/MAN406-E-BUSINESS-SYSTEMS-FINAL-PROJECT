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
                            <img src="<?php echo $getProducts['product_img']; ?>" class="card-img-top" alt="<?php echo $getProducts['prodct_title']; ?>" />
                            <div class="card-body">
                                <h5 class="card-title">₺ <?php echo $getProducts['product_price']; ?></h5>
                                <p class="card-text"><?php echo $getProducts['product_title']; ?></p>
                                <p class="card-text"><?php echo $getProducts['product_weight']; ?> gr</p>
                            </div>
                            <div class="add-button">
                                <i class="fas fa-plus" style="color:#4c3398;"></i>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-3">
            <div style="background-color: #fff; height: 100px; width: 100%;">

            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>