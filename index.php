<?php
    include "config/Database.php";
    $obj=new Database();
    $obj->select('options','site_title');
    $data=$obj->getResult();
    if(!empty($data)){
        $title=$data[0]['site_title'];
    }else{
        $title="MR Shopping";
    }
    include_once "header.inc.php";
?>
        <div id="banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-content ">
                            <div class="banner-carousel owl-carousel owl-theme">
                                <div class="item">
                                    <img src="images/img-2.jpg" alt=""/>
                                </div>
                                <div class="item">
                                    <img src="images/img-1.jpg" alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- popular products -->

        <div class="container-fluid mt-3 ">
            <div class="container">
            <div class="row">
                <h3 class="fw-bold text-center mt-2 mb-4" >Popular Products</h3>
                <div class="col-12">
                        <div class="popular-content owl-carousel owl-theme">
                            <?php
                                $obj->select('products','*',null,'product_views>0 and qty>0');
                                $result=$obj->getResult();
                                if(count($result)>0){
                                    foreach($result as $row){
                            ?>
                                        <div class="item d-flex align-items-center flex-column bg-light p-3 rounded">
                                            <div class="prd_img">
                                                <input type="text" value="<?php echo $row['product_id']; ?>" hidden class="prod_id">
                                                <img src="images/<?php echo $row['featured_image'] ?>" alt="" class="rounded">
                                            </div>
                                            <div class="button_group">
                                                <a href="single-product.php?id=<?php echo $row['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                                <i class="fa fa-shopping-cart add-to-cart" data-id="<?php echo $row['product_id']?>"></i>
                                                <i class="fa fa-heart add-to-wishlist" data-id="<?php echo $row['product_id'] ?>"></i>
                                            </div>
                                            <div class="prd_about d-flex align-items-center flex-column">
                                                <a href="#" class="nav-link fw-bold m-0">
                                                    <?php echo substr($row['product_title'],0,20),'...'; ?>
                                                </a>
                                                <span class="price fw-bold"><?php echo $row['product_price'] ?>Tk.</span>
                                            </div>
                                        </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                </div>
            </div>
        </div>
        </div>

<!-- products endsd -->
<!-- latest products starts-->

<div class="container-fluid mt-5 ">
    <div class="container">
    <div class="row">
        <h3 class="fw-bold text-center mt-2 mb-4" >Latest Products</h3>
        <div class="col-12">
                <div class="latest-content owl-carousel owl-theme">
                <?php
                                $obj->select('products','*',null,'product_views>0 and qty>0');
                                $result=$obj->getResult();
                                if(count($result)>0){
                                    foreach($result as $row){
                            ?>
                                        <div class="item d-flex align-items-center flex-column bg-light p-3 rounded">
                                            <div class="prd_img">
                                                <input type="text" value="<?php echo $row['product_id']; ?>" hidden class="prod_id">
                                                <img src="images/<?php echo $row['featured_image'] ?>" alt="" class="rounded">
                                            </div>
                                            <div class="button_group">
                                                <a href="single-product.php?id=<?php echo $row['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                                <i class="fa fa-shopping-cart add-to-cart" data-id="<?php echo $row['product_id']?>"></i>
                                                <i class="fa fa-heart add-to-wishlist" data-id="<?php echo $row['product_id'] ?>"></i>
                                            </div>
                                            <div class="prd_about d-flex align-items-center flex-column">
                                                <a href="#" class="nav-link fw-bold m-0">
                                                    <?php echo substr($row['product_title'],0,20),'...'; ?>
                                                </a>
                                                <span class="price fw-bold"><?php echo $row['product_price'] ?>Tk.</span>
                                            </div>
                                        </div>
                            <?php
                                }
                            }
                            ?>             
                </div>
        </div>
    </div>
</div>
</div>
<!-- latest products ends -->

<?php
    include_once "footer.inc.php";
?>


   