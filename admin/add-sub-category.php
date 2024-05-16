<?php
include_once 'header.inc.php';

?>
<div class="col-9 load-item">
    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
        <div class="admin-content-container">
            <h2 class="admin-heading">Add New Sub Category</h2>
            <div class="row">
                <!-- Form -->
                <form id="createSubCategory" class="add-post-form col-md-6" method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="sub_cat_name" class="form-control sub_category"
                            placeholder="Sub Category Name" />
                    </div>
                    <div class="form-group">
                        <label for="">Parent Category</label>
                        <select class="form-control parent_cat" name="parent_cat">
                            <option value="" selected disabled>Select Category</option>
                            <?php 
                                $db->select("categories","*");
                                $all_cat=$db->getResult();
                                if(count($all_cat)>0){
                                    foreach($all_cat as $single_cat){
                                        echo '<option value='.$single_cat['cat_id'].'>'.$single_cat['cat_title'].'</option>';
                                    }
                                }
                            ?>
                            
                            
                        </select>
                    </div>
                    <input type="submit" class="mt-3 text-light btn add-new bg-primary" name="submit" value="Submit">
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once 'footer.inc.php'; ?>