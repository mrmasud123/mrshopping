<?php
    include_once 'header.inc.php';

?>
                <div class="col-9 load-item">
                    
                        <div class="admin-content-container">
                            <h2 class="admin-heading mb-5">Add New Category</h2>
                            
                            <!-- Form -->
                            <div class="row">
                                <form id="createCategory" class="add-post-form col-md-6" method="POST">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="cat" class="form-control category" placeholder="Category Name"  required/>
                                    </div>
                                    <input type="submit" class="mt-3 text-light btn add-new bg-primary" name="submit" value="Submit">
                                </form>
                            </div>
                            <!-- /Form -->
                        </div>
                
            </div>
        </div>
    </div>
<?php include_once 'footer.inc.php'; ?>