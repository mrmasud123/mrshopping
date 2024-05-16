<?php
include_once 'header.inc.php';
$db->select('order_products', "*", null, null, "order_id DESC");


$all_orders = $db->getResult();
?>

<div class="col-10 load-item">
    <!--  -->
    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
        <div class="admin-content-container">
            <h2 class="admin-heading">All Orders</h2>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>ORDER No.</th>
                    <th width="300px">Product Details</th>
                    <th>QTY.</th>
                    <th>Total Amount</th>
                    <th width="150px">Customer Details</th>
                    <th width="150px">Order Date</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_orders as $order) {
                        $newArr = explode(",", $order['product_id']);
                        $all_qty=explode(",",$order['product_qty']);
                    ?>
                        <tr>
                            <td>
                                <?php echo "ORD" . $order['order_id'] ?>
                            </td>
                            <td>
                                <?php
                                
                                    for ($a = 0; $a < count($newArr); $a++) {
                                        if($newArr[$a] != null){
                                            echo "<b>Product Code : </b>PDR" . $newArr[$a] . "<b>Quantity : </b>" . $all_qty[$a] . "<br>";
                                        }
                                        
                                    }
                                ?>
                                
                            </td>
                            <td><?php 
                               if(count($all_qty)>1){
                                    echo count($all_qty)-1;
                               }else{
                                    echo count($all_qty);
                               }
                            ?></td>
                            <td>Rs. <?php echo $order['total_amount'] ?></td>
                            <td>
                                <?php 
                                    $u_id=$order['product_user'];
                                    $db->select("user","*",null,"user_id=$u_id");
                                    $user=$db->getResult();

                                ?>
                                <b>Name : </b><?php echo $user[0]['f_name'] ?><br>
                                <b>Address : </b><?php echo $user[0]['address'] ?><br>
                                <b>City : </b><?php echo $user[0]['city'] ?><br>
                            </td>
                            <td><?php echo date('d M, Y',strtotime($order['order_date']));?></td>
                            <td>
                                <span class="label rounded px-2 text-light bg-success">Paid</span>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary order_complete" href="" data-id="47">complete</a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--  -->
    </div>
</div>
</div>
</div>
<?php include_once 'footer.inc.php'; ?>