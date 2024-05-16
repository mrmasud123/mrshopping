<?php
session_start();
include_once 'config/Database.php';
    if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    
    $title=$_SESSION['userName']." - Profile";
    include_once "header.inc.php";
    $loggedEmail=$_SESSION['userEmail'];
    $obj->select('user','*',null, "email='$loggedEmail'");
    
    $data=$obj->getResult();
    $id=$data[0]['user_id'];
    $password=$data[0]['password'];
    $mobile=$data[0]['mobile'];
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-center flex-column">
            <div class="col-4 d-flex justify-content-center flex-column">
            <h2 class="fw-bold mt-2 mb-3 text-center"><?php echo $_SESSION['userName'] ?> Profile</h2>
                <div class="info_table">
                    <table class="table table-striped">
                        <tr>
                            <td class="fw-bold">Name : </td>
                            <td><?php echo $_SESSION['userName'] ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">E-mail : </td>
                            <td><?php echo $_SESSION['userEmail'] ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Password : </td>
                            <td><?php echo $password ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Mobile : </td>
                            <td><?php echo $mobile ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                <button class="btn btn-sm btn-primary mt-2 mb-2 p-0"><a href="edit-user.php?id=<?php echo $id; ?>" class="nav-link text-light">Modify Details</a></button>
                <button class="btn btn-sm btn-danger p-0"><a href="change-password.php" class="nav-link text-light">Change Password</a></button>
                <button class="btn btn-sm btn-info p-0"><a href="#" class="nav-link text-light">Orders</a></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "footer.inc.php";
?>