<?php 
    include_once '../config/Database.php';
    session_start();
    $db=new Database();
    $db->select('options',"*",null);
    $result=$db->getResult();
    $title_base=explode(".", basename($_SERVER['PHP_SELF']));
    $page_title="ADMIN || ";
    if(strtoupper($title_base[0])=="INDEX"){
        $page_title.="DASHBOARD";
    }else{
        $page_title.=strtoupper($title_base[0]);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="../images/<?php echo $result[0]['site_logo'] ?>" type="image/x-icon">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="index.php"><img src="images/site-logo.png" alt=""></a>
                </div>
                <div class="admin-info" style="width:160px">
                <?php 
                    $current_admin=$_SESSION['admin_id'];
                    $db->select('admin',"*",null,"admin_id='$current_admin'");
                    $admin_data=$db->getResult();
                    echo '
                        <button class="btn w-100 btn-primary" id="toggleAdmin">Hi '.$admin_data[0]['admin_name'].' <i class="fa fa-arrow-circle-down"></i></button>
                    ';
                ?>
                    
                    <div class="options">
                        <ul>
                            <li><a href="#" class="active nav-link">Change Password</a></li>
                            <li><a href="#" class="active nav-link logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <div class="col-2">
                    <div class="dasboard-option p-3">
                        <ul class="d-flex flex-column align-items-baseline">
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'class="active"' ?>><a href="index.php" class="nav-link w-100 text-start btn ">Dashboard</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='product.php') echo 'class="active"' ?>><a href="product.php" class="nav-link w-100 text-start btn ">Product</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='category.php') echo 'class="active"' ?>><a href="category.php" class="nav-link w-100 text-start btn ">Category</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='sub-category.php') echo 'class="active"' ?>><a href="sub-category.php" class="nav-link w-100 text-start btn">Sub category</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='brands.php') echo 'class="active"' ?>><a href="brands.php" class="nav-link w-100 text-start btn">Brands</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='orders.php') echo 'class="active"' ?>><a href="orders.php" class="nav-link w-100 text-start btn">Orders</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='users.php') echo 'class="active"' ?>><a href="users.php" class="nav-link w-100 text-start btn">Users</a></li>
                            <li <?php if(basename($_SERVER['PHP_SELF'])=='options.php') echo 'class="active"' ?>><a href="options.php" class="nav-link w-100 text-start btn">Options</a></li>  
                        </ul>
                    </div>
                </div>

