<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
    $obj=new Database();
    $obj->select('options','site_name,site_logo,currency_format');
    $result=$obj->getResult();
    if(!empty($result)){
        $currency_format=$result[0]['currency_format'];
    }else{
        $currency_format=" $";
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if(isset($title)){
                echo $title;
            }else{
                echo "MR Shopping";
            }
        ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/<?php echo $result[0]['site_logo'] ?>" type="image/x-icon">
     
</head>
<body>
    <!-- is logged in -->
    <?php 
        if(isset($_SESSION['userEmail'])){
            echo "<input class='isLoggedin' value=1 hidden>";
        }else{
            echo "<input class='isLoggedin' value=0 hidden>";
        }
    ?>
    <!-- add to cart msg -->
    <div class="message">
        <h4>Message goes here</h4>
    </div>
    <!-- sidebar-->
    <div id="sidebar" class="bg-danger">
        <i class="fa fa-times fw-lighter" id="sidebarClose"></i>
        <?php
            
            if(isset($_SESSION['user_role'])){
            ?>
            <div class="sidebar-content">
            <div class="u_info mb-4 d-flex align-items-center justify-content-center flex-column">
                <img src="images/about.jpg" alt="" class="mb-2 rounded">
                <h4 class="fw-bold">Hello <?php echo $_SESSION['userName'] ?></h4>
            </div>
            <div class="info d-flex justify-content-center flex-column">
                <button class="mt-3 btn btn-sm btn-info"><a href="user-profile.php" class="nav-link text-light">View Profile?</a></button>
                <button class="mt-3 btn btn-sm btn-success"><a href="cart.php" class="nav-link text-light">View Cart?</a></button>
                <button class="btn mt-3 btn-primary user_logout text-light" >Logout</button>
            </div>
        </div>
        <?php
            }else{
                echo "
                    <div class='d-flex align-items-center justify-content-center flex-column'>
                        <span>Please Login First.</span>
                        <button class='btn btn-success' id='login_request'>Login?</button>
                    </div>
                ";
            }
        ?>
    </div>
    <!-- sidebar ends -->
    <div class="container-fluid p-0" id="Header">
        <div class="row">
            <div class="col d-flex align-items-center flex-column">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div class="col-2 me-3">
                        <a href="index.php" class="nav-link"><img src="images/site-logo.png" class="" alt=""></a>
                    </div>
                    <div class="col-7 mt-3">
                        <form action="search.php" method="GET">
                            <div class="input-group search">
                                <input type="text" class="form-control" name="search" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <input class="btn btn-default" type="submit" value="Search" />
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-2 text-end">
                        <a href="wishlist.php">
                            <i class="fa fa-heart" ></i>
                            <sup id="totalWishList" style="font-size:20px"></sup>
                        </a>
                        <a href="cart.php" class="cart me-3">
                            <i class="fa fa-shopping-cart"></i>
                            <sup id="totalCart" style="font-size:20px"></sup>
                        </a>
                        <i class="fa fa-navicon me-5" id="sidebarOpen"></i>
                    </div>
                </div>
                <div class="categories d-flex align-items-center col-12 justify-content-center flex-wrap mb-2">
                    <?php
                        $obj->select('sub_categories','*',null,'cat_products > 0 AND show_in_header = "1"',null,null);
                        $category=$obj->getResult();
                        if(count($category)>0){
                            foreach($category as $cat){
                        ?>
                            <button class="m-1 btn-sm btn btn-danger"><a class="text-light nav-link text-uppercase" href="category.php?cat_id=<?php echo $cat['sub_cat_id']; ?>"><?php echo $cat['sub_cat_title']; ?></a></button>
                        <?php
                            }
                        }
                    ?>
                    
        
                </div>
            </div>
        </div>
    </div>

    <!-- login modal -->

<div id="lg_modal" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <form id="loginUser" method ="POST">
                    <div class="customer_login"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>login here</h2>
                            <i class="fa fa-times fw-lighter position-relative top-0 right-0 " id="loginClose"></i>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="email" class="form-control username" placeholder="Username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control password" placeholder="password" autocomplete="off" required>
                        </div>
                        <div class="btn-section d-flex align-items-center flex-column mt-2 w-100">
                            <input type="submit" name="login" class="btn btn-primary w-50" value="login"/>
                        <span>Don't Have an Account <a class="btn-success px-2 rounded py-2"  href="register.php">Register</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- login modal ends -->