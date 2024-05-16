<?php
    include_once 'config/Database.php';
    $db=new Database();
    $search_term=$db->escapeString($_GET['search']);
    if($search_term==''){
        Header("location: ". $db->hostname);
    }else{
        
        $title="Searching For - ". $search_term;
    }
    include 'header.inc.php';
    
?>

<!-- contents starts -->
<div class="container-fluid p-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-evenly">
                <div class="col-8 d-flex align-items-center justify-content-between flex-wrap flex-column">
                    <h2 class="text-center mb-3"><?php echo $title; ?></h2>
                    <div class="all-products d-flex align-items-center justify-content-center flex-wrap">

                    <?php
                        /* $db->select('products',"*",null,"product_title like '%{$search_term}%'"); */
                        $db->select('products','*',null,"product_title LIKE '%{$search_term}%'");
                        $details=$db->getResult();
                        if(count($details)>0){
                            foreach($details as $details){
                        ?>
                                             
                        <div class="cat_item d-flex align-items-center flex-column p-3 rounded">
                            <div class="prd_img">
                                <img src="images/<?php echo $details['featured_image']  ?>" alt="" class="rounded">                                
                            </div>
                            <div class="button">
                                <a href="single-product.php?id=<?php echo $details['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                <i class="fa fa-shopping-cart add-to-cart" data-id="<?php echo $details['product_id']?>"></i>
                                <i class="fa fa-heart add-to-wishlist" data-id="<?php echo $details['product_id'] ?>"></i>
                            </div>
                            <div class="prd_about d-flex align-items-center flex-column">
                                                <a href="#" class="nav-link fw-bold m-0">
                                                    <?php echo substr($details['product_title'],0,20),'...'; ?>
                                                </a>
                                                <span class="price fw-bold"><?php echo $details['product_price'] ?>Tk.</span>
                                            </div>
                        </div>

                        <?php
                            }
                        }else{
                            echo "<h4>No products found ☺.</h4>";
                        }
                    ?>
                        

                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- contents☻ ends -->

<?php
    include 'footer.inc.php';
?>