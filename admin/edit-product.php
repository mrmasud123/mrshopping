<?php
    include_once 'header.inc.php';
    $product_id=$_GET['id'];
    $db->select('products',"*",null,"product_id=$product_id");
    $product_details=$db->getResult();
?>
                <div class="col-9 load-item">
                   <!--  -->
                   <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
                    <div class="admin-content-container">
                        <h2 class="admin-heading mb-5">Update Product</h2>
                        <form id="updateProduct" class="add-post-form row" method="post" enctype="multipart/form-data">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Product Title</label>
                                    <input type="hidden" class="form-control product_id" name="product_id" placeholder="Product Title" value="<?php echo $product_details[0]['product_id'] ?>" requried/>
                                    <input type="text" class="form-control product_title" name="product_title" placeholder="Product Title" value="<?php echo $product_details[0]['product_title'] ?>" requried/>
                                </div>
                                <div class="csb mb-2 mt-2 d-flex align-items-center justify-content-between">
                                    <?php
                                        $db->select("categories","*",null,null);
                                        $all_cat=$db->getResult();
                                    ?>
                                    <div class="form-group category">
                                        <label for="">Product Category</label>
                                        <select class="form-control product_category" name="product_cat">
                                            <option value="" selected disabled>Select Category</option>
                                            <?php 
                                            foreach($all_cat as $single_cat){
                                                if($product_details[0]['product_cat']==$single_cat['cat_id']){
                                                echo '<option selected value='.$single_cat['cat_id'].'>'.$single_cat['cat_title'].'</option>';
                                                }else{
                                                    echo '<option  value='.$single_cat['cat_id'].'>'.$single_cat['cat_title'].'</option>';
                                                }
                                            }
                                                
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group sub_category">
                                        <label for="">Product Sub-Category</label>
                                        <select class="form-control product_sub_category" name="product_sub_cat">
                                            <?php 
                                                $db->select('sub_categories',"*",null,"cat_parent='{$product_details[0]['product_cat']}'");
                                                $all_sub_cat=$db->getResult();
                                                foreach($all_sub_cat as $sub_cat){
                                                    if($product_details[0]['product_cat']==$sub_cat['cat_parent']){
                                                        echo '<option selected value='.$sub_cat['sub_cat_id'].' selected >'.$sub_cat['sub_cat_title'].'</option>';
                                                    }else{
                                                        echo '<option value='.$sub_cat['sub_cat_id'].' selected >'.$sub_cat['sub_cat_title'].'</option>';
                                                    }
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group brand">
                                        <label for="">Product Brand</label>
                                        <select class="form-control product_brands" name="product_brand">
                                        <?php 
                                                $db->select('brands',"*",null,"brand_cat='{$product_details[0]['product_brand']}'");
                                                $all_brands=$db->getResult();
                                                if(count($all_brands)>0){
                                                    foreach($all_brands as $brand){
                                                        if($product_details[0]['product_cat']==$brand['brand_id']){
                                                            echo '<option selected value='.$brand['brand_id'].' selected >'.$brand['brand_title'].'</option>';
                                                        }else{
                                                            echo '<option value='.$brand['brand_id'].' selected >'.$brand['brand_title'].'</option>';
                                                        }
                                                    }
                                                }else{
                                                    echo '<option selected value="0" selected >No brand Available</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Product Description</label>
                                    <textarea class="form-control product_description" name="product_desc" rows="8" cols="80" requried><?php echo $product_details[0]['product_desc'] ?></textarea>
                                </div>
                                <div class="show-error"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Featured Image</label>
                                    <input type="file" class="product_image" name="new_image">
                                    <input type="hidden" class="old_image" name="old_image" value="<?php echo $product_details[0]['featured_image']; ?>">
                                    <img id="image" src="../images/<?php echo $product_details[0]['featured_image']; ?>" alt="" width="100px"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <input type="text" class="form-control product_price" name="product_price" requried value="<?php echo $product_details[0]['product_price'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Available Quantity</label>
                                    <input type="number" class="form-control product_qty" name="product_qty" requried value="<?php echo $product_details[0]['qty'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control product_status" name="product_status">
                                    <?php
                                        if($product_details[0]['product_status'] == 1){
                                            echo "<option selected value=".$product_details[0]['product_status'].">Published</option>";
                                        }else if($product_details[0]['product_status']==0){
                                            echo "<option value=" . $product_details[0]['product_status'] . ">Draft</option>";
                                        }
                                    ?>
                                       
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="submit" class="text-light btn update-prd bg-primary" name="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                   <!--  -->
                </div>
            </div>
        </div>
    </div>
<?php 
    include_once 'footer.inc.php';
?>