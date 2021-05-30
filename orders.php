<?php
ob_start();
session_start();
include "./settings/connection.php";
$askOrders = $db->prepare("SELECT * FROM orders");
$askOrders->execute();

$askOrderStatus = $db->prepare("SELECT * FROM order_status");
$askOrderStatus->execute();

?>
<?php require_once "header.php"; ?>

<div class="container mt-4">
    <div style="display: flex; justify-content: space-between;">
        <h3>Orders</h3>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
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
                    <td><?php echo $getOrders['user_email']; ?></td>
                    <td><?php echo $getOrders['order_price']; ?></td>
                    <form action="./settings/operations.php" method="POST">
                        <td>
                            <select class="custom-select mb-3" name="order_status">
                                <?php
                                while ($getOrderStatus = $askOrderStatus->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option <?php if ($getOrders['order_status'] == $getOrderStatus['status_id']) {
                                                echo "selected";
                                            } ?> value="<?php echo $getOrderStatus['status_id'] ?>"><?php echo $getOrderStatus['status_title'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" value="<?php echo $getOrders['order_id']; ?>" name="order_id">
                        </td>
                        <td>
                            <button name="updateOrderStatus" type="submit" class="btn btn-success">Update</button>
                        </td>
                    </form>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
require_once "footer.php";
?>