<?php
include_once 'header.inc.php';
if(!isset($_SESSION['admin_id'])){
    header("location: login.php");
}
?>
                <div class="col-9 load-item">
                    <h2 class="fw-bold">Dashboard</h2>
                    <?php
                    $db = new Database();
                    $db->select('products','product_id',null,'qty < 1',null,0);
                    $qty = $db->getResult();
                    if(!empty($qty)){  ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="act"><td colspan="2">OUT OF Stock</td></tr>
                            </thead>
                            <tbody>
                                <?php foreach($qty as $q){ ?>
                                    <tr>
                                    <td>Product Code</td>
                                    <td><?php echo 'PDR00'.$q['product_id']; ?></td>
                                </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <div class="w-100 dashboard-content d-flex align-items-center justify-content-center flex-wrap"> 
                        <?php 
                            $db->select('products',"COUNT(product_id) as prod");
                            $products=$db->getResult();
                        ?>  
                        <div class="box">
                            <h2 class="item-number"><?php echo $products[0]['prod'] ?></h2>
                            <span class="item-name">Products</span>
                        </div>
                        <div class="box">
                        <?php 
                            $db=new Database();
                            $db->select('categories',"COUNT(cat_id) as c_count");
                            $category=$db->getResult();
                        ?>
                            <h2 class="item-number"><?php echo $category[0]['c_count'] ?></h2>
                            <span class="item-name">Category</span>
                        </div>
                       
                        <div class="box">
                        <?php 
                            $db=new Database();
                            $db->select('sub_categories','COUNT(sub_cat_id) as sub_count',null,null,null,0);
                            $sub_category = $db->getResult();
                        ?>
                            <h2 class="item-number"><?php echo $sub_category[0]['sub_count'] ?></h2>
                            <span class="item-name">Sub Category</span>
                        </div>

                        <div class="box">
                        <?php 
                            $db=new Database();
                            $db->select('brands','COUNT(brand_id) as b_count',null,null,null,0);
                            $brands = $db->getResult();
                        ?>
                            <h2 class="item-number"><?php echo $brands[0]['b_count'] ?></h2>
                            <span class="item-name">Brands</span>
                        </div>

                        <div class="box">
                        <?php 
                            $db=new Database();
                           $db->select('order_products','COUNT(order_id) as o_count',null,null,null,0);
                           $orders = $db->getResult();
                        ?>
                            <h2 class="item-number"><?php echo $orders[0]['o_count'] ?></h2>
                            <span class="item-name">Orders</span>
                        </div>

                        <div class="box">
                        <?php 
                            $db=new Database();
                           $db->select('user','COUNT(user_id) as u_count',null,null,null,0);
                           $users = $db->getResult();
                        ?>
                            <h2 class="item-number"><?php echo $users[0]['u_count'] ?></h2>
                            <span class="item-name">Users</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.inc.php'; ?>