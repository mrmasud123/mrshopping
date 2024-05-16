<?php
include_once 'header.inc.php';

?>
<div class="col-9 load-item">
    <div class="admin-content-container">
    <div class="bg-danger text-light mb-3 p-2 rounded">Note: Deleting category is confidential. If a category is deleted , related to this category products and sub category will be deleted.</div>
        <div class="mb-3 prd-header d-flex align-items-center justify-content-between">
            
            <h2>All products</h2>
            <a href="add-category.php" class="btn btn-primary" style="border-radius: 100px;">Add new?</a>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>Title</th>
                <th>No Of Products</th>
                <th>No Of sub category</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                    $db->select("categories","*");
                    $categories=$db->getResult();
                    if(count($categories)>0){
                        foreach($categories as $category){
                            $catId=$category['cat_id'];
                            $db->sql("SELECT COUNT(product_id) as total from products where product_cat=$catId");
                            $total_prd=$db->getResult();
                            $db->sql("SELECT COUNT(sub_cat_id) as sub_cat from sub_categories where cat_parent=$catId");
                            $sub_cat=$db->getResult();
                    ?>
                    <tr>
                        <td><?php echo $category['cat_title'] ?></td>
                        <td><?php echo $category['products'] ?></td>
                        <td><?php echo $sub_cat[0][0]['sub_cat'] ?></td>
                        
                        <td>
                            <a href="edit-cat.php?id=<?php echo $category['cat_id'] ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete_category" href="" data-id="<?php echo $category['cat_id'] ?>"><i class="fa fa-trash"></i></a>
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
<?php include_once 'footer.inc.php'; ?>