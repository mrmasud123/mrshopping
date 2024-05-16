<?php
    include_once 'header.inc.php';

?>
                <div class="col-9 load-item">
                       <!--  -->             

                       
                        <div class="admin-content-container">
                            <div class="mb-3 prd-header d-flex align-items-center justify-content-between">
                                <h2>All Brands</h2>
                                <a href="add-brand.php" class="btn btn-primary" style="border-radius: 100px;">Add new?</a>
                            </div>
                                    <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                                    <tr>
                                            <td>Realme</td>
                                            <td>Electronics</td>
                                            <td>
                                                <a href="edit_brand.php?id=13"><i class="fa fa-edit"></i></a>
                                                <a class="delete_brand" href="javascript:void();" data-id="13"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                                    <tr>
                                            <td>Lenovo</td>
                                            <td>Electronics</td>
                                            <td>
                                                <a href="edit_brand.php?id=12"><i class="fa fa-edit"></i></a>
                                                <a class="delete_brand" href="javascript:void();" data-id="12"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                                    <tr>
                                            <td>LG</td>
                                            <td>Electronics</td>
                                            <td>
                                                <a href="edit_brand.php?id=11"><i class="fa fa-edit"></i></a>
                                                <a class="delete_brand" href="javascript:void();" data-id="11"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                                    <tr>
                                            <td>Samsung</td>
                                            <td>Electronics</td>
                                            <td>
                                                <a href="edit_brand.php?id=10"><i class="fa fa-edit"></i></a>
                                                <a class="delete_brand" href="javascript:void();" data-id="10"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                                </tbody>
                                </table>
                        </div>
                        
                       <!--  -->
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