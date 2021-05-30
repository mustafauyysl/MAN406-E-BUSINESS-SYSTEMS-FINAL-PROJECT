<?php

include "./settings/connection.php";
$askCategories = $db->prepare("SELECT * FROM categories");
$askCategories->execute();

$askProducts = $db->prepare("SELECT * FROM products where product_id=:id");
$askProducts->execute(array(
    'id' => $_GET['id']
));

$getProducts = $askProducts->fetch(PDO::FETCH_ASSOC);

require_once "header.php";

?>

<div class="container mt-4">
    <h3><?php if ($_GET['id']) { ?> Update Product <?php } else { ?>Add New Product<?php } ?></h3>
    <form class="mt-5" action="./settings/operations.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Image Link</label>
            <input type="text" class="form-control" name="product_img" value="<?php echo $getProducts['product_img']; ?>">
        </div>
        <label for="exampleInputEmail1">Category</label>
        <select class="custom-select mb-3" name="category_id">
            <?php
            while ($getCategory = $askCategories->fetch(PDO::FETCH_ASSOC)) { ?>
                <option <?php if ($getProducts['category_id'] == $getCategory['category_id']) {
                            echo "selected";
                        } ?> value="<?php echo $getCategory['category_id'] ?>"><?php echo $getCategory['category_title'] ?></option>
            <?php } ?>
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="product_title" value="<?php echo $getProducts['product_title']; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" name="product_price" value="<?php echo $getProducts['product_price']; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Weight</label>
            <input type="text" class="form-control" name="product_weight" value="<?php echo $getProducts['product_weight']; ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="product_id" value="<?php echo $getProducts['product_id']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" <?php if ($_GET['id']) { ?> name="updateProduct" <?php } else { ?> name="addProduct" <?php } ?>><?php if ($_GET['id']) { ?> Update Product <?php } else { ?>Add Product<?php } ?></button>
    </form>
</div>

<?php
require_once "footer.php";
?>