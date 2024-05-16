<?php

    include_once 'header.inc.php';
?>
                <div class="col-9 load-item">
                    <div class="mb-3 prd-header d-flex align-items-center justify-content-between">
                        <h2>All products</h2>
                        <a href="add-product.php" class="btn btn-primary" style="border-radius: 100px;">Add new?</a>
                    </div>
                    <div class="all-products">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    /* $db->sql("SELECT * from products INNER JOIN sub_categories ON products.product_sub_cat=sub_categories.sub_cat_id LEFT JOIN brands ON products.product_brand=brands.brand_id"); */
                                    $db->select("products","*",'sub_categories ON products.product_sub_cat=sub_categories.sub_cat_id LEFT JOIN brands ON products.product_brand=brands.brand_id',null,"product_id DESC");
                                    $allprod=$db->getResult();
                                    if(count($allprod)>0){
                                        foreach($allprod as $product){
                                
                                ?>

                                <tr>
                                    <td class="fw-bold">PRD00<?php echo $product['product_id'] ?></td>
                                    <td><?php echo $product['product_title'] ?></td>
                                    <td><?php echo $product['sub_cat_title'] ?></td>
                                    <td><?php echo $product['brand_title'] ?></td>
                                    <td>Tk. <span><?php echo $product['product_price'] ?></span></td>
                                    <td><?php echo $product['qty'] ?></td>
                                    <td class="prod_img">
                                        <img src="../images/<?php echo $product['featured_image'] ?>" alt="">
                                    </td>
                                    <td><button class="btn btn-info btn-sm"><?php 
                                        if($product['product_status']){echo "Active";}else{echo "Inactive";}
                                    ?></button></td>
                                    <td>
                                        <a href="edit-product.php?id=<?php echo $product['product_id']; ?> " class="text-dark"><i class="fa fa-edit admin_edit"></i></a>
                                        <i class="fa fa-trash admin_delete" data-id="<?php echo $product['product_id'] ?>"></i>
                                    </td>
                                </tr>

                                <?php 
                                        }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    include_once 'footer.inc.php';
?>