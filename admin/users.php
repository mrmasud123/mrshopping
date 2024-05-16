<?php
include_once 'header.inc.php';
$db->select('user', '*', null);
$all_users = $db->getResult();
?>
<div class="col-10 load-item">
    <!-- <div class="col-10" id="admin-content"> -->
        <div class="admin-content-container">
            <h2 class="admin-heading">All Users</h2>
            <table class="w-100 table table-striped table-hover table-bordered">
                <thead>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>City</th>
                    <th style="width:150px !important">Action</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_users as $single_user) {

                        ?>
                        <tr>
                            <td>
                                <?php echo $single_user['f_name'] ?>
                            </td>
                            <td>
                                <?php echo $single_user['email'] ?>
                            </td>
                            <td>
                                <?php echo $single_user['password'] ?>
                            </td>
                            <td>
                                <?php echo $single_user['mobile'] ?>
                            </td>
                            <td>
                                <?php echo $single_user['address'] ?>
                            </td>
                            <td>
                                <?php echo $single_user['city'] ?>
                            </td>
                            <td class="d-flex align-item-center justify-content-between">
                                <a href="" class="btn btn-xs btn-primary user-view" data-id="18" data-toggle="modal" data-target="#user-detail"><i class="fa fa-eye"></i></a>
                                <a href="" class="me-1 ms-1 btn btn-sm btn-primary user-status" data-id="18" data-status="1">Block</a>
                                <a class="btn btn-xs btn-danger delete_user" href="javascript:void();" data-id="18"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        <!-- </div> -->
    </div>
</div>
</div>
</div>
<div class="container-fluid bg-info">
    <h4 class="text-center">All Copyrights Reserved To mrmasud2023</h4>
</div>
<script src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#toggleAdmin").click(function () {
            $(".options").toggleClass("sh");
        });

    });
</script>
</body>

</html>