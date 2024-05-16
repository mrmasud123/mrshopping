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
                        <h2 class="admin-heading mb-5">Update sub category</h2>
                        <?php
                            $sub_cat_id = $_GET['id'];
                            $db = new Database();
                            $db->select('sub_categories','*',null,"sub_cat_id ='{$sub_cat_id}'",null,null);
                            $result = $db->getResult();
                            if ($result > 0) {
                        ?>
                        <form id="updateSubCategory" class="add-post-form col-md-6" method ="POST">
                            <input type="hidden" name="cat_id" value="<?php echo $sub_cat_id; ?>">
                            <input type="hidden" name="cat_parent_id" value="<?php echo $result[0]['cat_parent']; ?>">
                            <div class="form-group">
                                <label>Sub category Name</label>
                                <input type="text" name="sub_cat_name" class="form-control" value="<?php echo $result[0]['sub_cat_title'] ?>"  placeholder="Sub Category Name" required />
                            </div>
                            <div class="form-group">
                                <label>Sub Category Product</label>
                                <input type="number" name="prd_qty" class="form-control" value="<?php echo $result[0]['cat_products']; ?>"  placeholder="Sub Category products" required />
                            </div>
                            <input type="submit" class="text-light mt-2 btn update-prd bg-primary" name="submit" value="Update">
                        </form>
                        <?php } ?>
                    </div>
                   <!--  -->
                </div>
            </div>
        </div>
    </div>
<?php 
    include_once 'footer.inc.php';
?>