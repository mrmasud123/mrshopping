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
                        <h2 class="admin-heading mb-5">Update category</h2>
                        <?php
                            $cat_id = $_GET['id'];
                            $db = new Database();
                            $db->select('categories','*',null,"cat_id ='{$cat_id}'",null,null);
                            $result = $db->getResult();
                            if ($result > 0) {
                        ?>
                        <form id="updateCategory" class="add-post-form col-md-6" method ="POST">
                            <input type="hidden" name="cat_id" value="<?php echo $result[0]['cat_id']; ?>">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $result[0]['cat_title']; ?>"  placeholder="Category Name" required />
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