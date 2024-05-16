<?php
    include_once 'header.inc.php';

?>
                <div class="col-9 load-item">
                    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">

                        <div class="admin-content-container">
                            <h2 class="admin-heading">Add New Brand</h2>
                            <div class="row">
                                        <!-- Form -->
                                <form id="createBrand" class="add-post-form col-md-6" method="POST"
                                      autocomplete="off">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Brand Category</label>
                                        <select class="form-control brand_category" name="brand_cat">
                                            <option value="" selected disabled>Select Category</option>
                                            <option value="9">Electronics</option>
                                            <option value="10">Men</option>
                                            <option value="11">Women</option>
                                            <option value="12">Furniture</option>
                                        </select>
                                    </div>
                                    <input type="submit" name="save" class="mt-2 bg-primary text-light btn add-new" value="Submit"/></button>

                                </form>
                                <!-- /Form -->
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-info">
        <h4 class="text-center">All Copyrights Reserved To mrmasud2023</h4>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#toggleAdmin").click(function(){
                $(".options").toggleClass("sh");
            });

        });
    </script>
</body>
</html>