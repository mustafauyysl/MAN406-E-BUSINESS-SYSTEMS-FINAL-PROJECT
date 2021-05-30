<?php
ob_start();
session_start();
include "./settings/connection.php";
$askProducts = $db->prepare("SELECT * FROM products");
$askProducts->execute();

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

<div class="container mt-4">
    <div style="display: flex; justify-content: space-between;">
        <h3>Products</h3>
        <a href="product-form.php" class="btn btn-success"><i class="fas fa-plus"></i></a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price (₺)</th>
                <th scope="col">Weight</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            while ($getProducts = $askProducts->fetch(PDO::FETCH_ASSOC)) {
                $count++;
            ?>
                <tr>
                    <td scope="row"><?php echo $count; ?></td>
                    <td>
                        <?php

                        $askCategories = $db->prepare("SELECT * FROM categories WHERE category_id=:id");
                        $askCategories->execute(array(
                            'id' => $getProducts['category_id']
                        ));
                        $getCategory = $askCategories->fetch(PDO::FETCH_ASSOC)
                        ?>

                        <?php echo $getCategory['category_title']; ?></td>
                    <td>
                        <img src="<?php echo $getProducts['product_img']; ?>" width="50" height="50" />
                    </td>
                    <td><?php echo $getProducts['product_title']; ?></td>
                    <td><?php echo $getProducts['product_price']; ?></td>
                    <td><?php echo $getProducts['product_weight']; ?></td>
                    <td><a onclick="return confirm('Are you sure to delete product ?')" type="button" class="btn btn-danger" href="./settings/operations.php?id=<?php echo $getProducts['product_id'] ?>&delete=ok"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td><a type="button" class="btn btn-warning" href="product-form.php?id=<?php echo $getProducts['product_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
require_once "footer.php";
?>