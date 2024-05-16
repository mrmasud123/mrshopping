<?php
include_once 'header.inc.php';

?>
<div class="col-9 load-item">

    <div class="admin-content-container">
        <div class="mb-3 prd-header d-flex align-items-center justify-content-between">
            <h2>All Sub-category</h2>
            <a href="add-sub-category.php" class="btn btn-primary" style="border-radius: 100px;">Add new?</a>
        </div>
        <table class="table ">
            <thead>
                <th>Title</th>
                <th>Category</th>
                <th>Total Products</th>
                <th>Show in Header</th>
                <th>Show in Footer</th>
                <th>Action</th>
            </thead>
            <tbody>

                <?php
                $db->select('sub_categories', "*");
                $all_sub_cat = $db->getResult();
                if (count($all_sub_cat) > 0) {
                    foreach ($all_sub_cat as $single_sub_cat) {
                        $parent_cat_id = $single_sub_cat['cat_parent'];
                        $db->select('categories', 'cat_title', null, "cat_id=$parent_cat_id");
                        $parent_cat_name = $db->getResult();
                        ?>
                        <tr>
                            <td><?php echo $single_sub_cat['sub_cat_title'] ?></td>
                            <td><?php echo $parent_cat_name[0]['cat_title'] ?></td>
                            <td><?php echo $single_sub_cat['cat_products'] ?></td>
                            <td>
                                <?php  
                                    if($single_sub_cat['show_in_header']==1){
                                        echo '<input type="checkbox" class="toggle-checkbox showCat_Header" data-id='.$single_sub_cat['sub_cat_id'].' checked />';
                                    }else{
                                        echo '<input type="checkbox" class="toggle-checkbox showCat_Header" data-id='.$single_sub_cat['sub_cat_id'].' />';
                                    }
                                ?>
                                
                            </td>
                            <td>
                            <?php  
                                    if($single_sub_cat['show_in_footer']==1){
                                        echo '<input type="checkbox" class="toggle-checkbox showCat_Footer" data-id='.$single_sub_cat['sub_cat_id'].' checked />';
                                    }else{
                                        echo '<input type="checkbox" class="toggle-checkbox showCat_Footer" data-id='.$single_sub_cat['sub_cat_id'].' />';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="edit-sub-cat.php?id=<?php echo $single_sub_cat['sub_cat_id'] ?>"><i class="fa fa-edit"></i></a>
                                <a class="delete_subCategory" href="javascript:void();" data-id="28"><i
                                        class="fa fa-trash"></i></a>
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
<?php include_once 'footer.inc.php'; ?>