<?php
    session_start();
    include_once 'config/Database.php';
    $title=$_SESSION['userName']." - Modify Profile";
    include_once "header.inc.php";
    $obj->select('user','*');
    $result=$obj->getResult();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-center flex-column">
            <div class="col-6 border p-5 d-flex justify-content-center flex-column">
            <h2 class="fw-bold mt-2 mb-3 text-center">Modify Profile</h2>
                <div class="info_table">
                <form id="modify-user" method="POST">                       
                                
                            <div class="form-group d-flex align-items-center mt-2 justify-content-between">
                                <label>Fullname</label>
                                <input hidden type="text" name="user_id" class="w-75 form-control user_id" value="<?php echo $result[0]['user_id']; ?>">
                                <input type="text" name="f_name" class="w-75 form-control fullname"
                                       placeholder="First Name" value="<?php echo $result[0]['f_name']; ?>" requried>
                            </div>
                            
                            <div class="form-group d-flex align-items-center  mt-2 justify-content-between">
                                <label>Mobile</label>
                                <input type="phone" name="mobile" class="w-75 form-control mobile" placeholder="Mobile"
                                       value="<?php echo $result[0]['mobile']; ?>" requried>
                            </div>
                            
                            <div class="form-group d-flex align-items-center mt-2 justify-content-between">
                                <label>Email</label>
                                <input type="email" name="email" class="w-75 form-control email" placeholder="email" value="<?php echo $result[0]['email']; ?>" requried>
                            </div>
                            <input class="btn mt-2 btn-info" type="submit" name="modify" value="Modify"/>
                        
                    </form>
                </div>
             
            </div>
        </div>
    </div>
</div>

<?php
    include_once "footer.inc.php";
?>