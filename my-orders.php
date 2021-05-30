<?php
ob_start();
session_start();
include "./settings/connection.php";
$askOrders = $db->prepare("SELECT * FROM orders WHERE user_email=:user_email");
$askOrders->execute(array(
    'user_email' => $_SESSION['user_email']
));

?>
<?php require_once "header.php"; ?>

<div class="container mt-4">
    <div style="display: flex; justify-content: space-between;">
        <h3>My Orders</h3>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            while ($getOrders = $askOrders->fetch(PDO::FETCH_ASSOC)) {
                $count++;
            ?>
                <tr>
                    <td scope="row"><?php echo $count; ?></td>
                    <td><?php echo $getOrders['order_price']; ?></td>
                    <td>
                        <?php  if($getOrders['order_status'] == 1) {
                            echo "Your order is preparing";
                        } else {
                            echo "Your order is on the way";
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
require_once "footer.php";
?>