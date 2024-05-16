<?php
    session_start();
    include_once 'config/Database.php';
    $obj=new Database();
    $prd_id=$_GET['id'];
    if(!isset($_SESSION['userEmail'])){
        $loggedEmail="";
    }else{
        $logg☻edEmail=$_SESSION['userEmail'];
    }
    $obj->select('products','*',null, "product_id='$prd_id'");
    $prd_details=$obj->getResult();
    $sub_category=$prd_details[0]['product_sub_cat'];
    $obj->select('sub_categories',"*",null,"sub_cat_id='$sub_category'");
    $cat_name=$obj->getResult()[0]['sub_cat_title'];
    if(count($prd_details)>0){
        $title=$cat_name." - ".$prd_details[0]['product_title'];
    }
    include_once "header.inc.php";

?>
<!-- contents -->
<div class="container-fluid single_product">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-evenly">
                <div class="col-4">
                    <div class="product_img">
                    <img id="product-img" src="images/<?php echo $prd_details[0]['featured_image'] ?>" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="sub-links">
                        <ul class="d-flex align-items-center">
                            <li><a href="index.php" class="ps-0 nav-link text-dark">Home</a></li>/
                            <li><a href="#" class="nav-link text-capitalize text-dark"><?php echo $cat_name; ?></a></li>/
                            <li><a  class="nav-link text-secondary"><?php echo substr($prd_details[0]['product_title'], 0,30)."....."; ?></a></li>
                        </ul>
                    </div>
                    <div class="product_details">
                        <h4 class="fw-bold text-capitalize mb-2"><?php echo $prd_details[0]['product_title'] ?></h4>
                        <h4 class="price text-capitalize mb-2">Rs. <?php echo $prd_details[0]['product_price'] ?></h4>
                        <span class="details mb-5">
                            <?php echo $prd_details[0]['product_desc'] ?>
                        </span>
                        <div class="buttons">
                            <button class="btn btn-danger add-to-cart" data-id="<?php echo $prd_details[0]['product_id'] ?>">ADD TO CART?</button>
                            <button class="btn btn-danger add-to-wishlist" data-id="<?php echo $prd_details[0]['product_id'] ?>">ADD TO WISHLIST?</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content ends -->
<?php
    include_once "footer.inc.php";
?>