<?php
session_start();
include "config/Database.php";
$db=new Database();
    if(!isset($_SESSION['userEmail'])){
        header("location:". $db->hostname);
    }
    $loggedEmail=$_SESSION['userEmail'];
    
    $db->select('user',"*",null,"email='$loggedEmail'");
    $data=$db->getResult();
    $name=$data[0]['f_name'];
    $title=$name." - Wishlist";
    include_once "header.inc.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-2 display-6 text-center">My wishlist</h4>
            <table class="table table-stripped">
                <tr>
                    <th>Product image</th>
                    <th>Product Name</th>
                    <th>product Price</th>
                    <th>Action</th>
                </tr>
                <?php
                    $db->select('tmp_wishlist',"*");
                    $wishlist=$db->getResult();
                    if(count($wishlist)>0){
                        foreach($wishlist as $wish){
                            $pid=$wish['p_id'];
                            $db->select("products","*",null,"product_id='$pid'");
                            $single_prd=$db->getResult();
                           
                    ?>
                <tr>
                    <td class="p-2"><img src="images/<?php echo $single_prd[0]['featured_image'] ?>" style="border-radius:50%;width:150px;height:150px" alt=""></td>
                    <td class="p-2"><?php echo $single_prd[0]['product_title'] ?></td>
                    <td class="p-2"><?php echo $single_prd[0]['product_price'] ?> Tk.</td>
                    <td class="p-2"><button class="btn btn-sm btn-primary" ><i data-id="<?php echo $single_prd[0]['product_id']; ?>" class="fa fa-remove text-light remove-wishlist-item"></i></button></td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                
                
            </table>
            <button class="btn btn-sm btn-primary"><a href="cart.php" class="nav-link text-light">Proceed to cart?</a></button>
        </div>
    </div>
</div>

<?php
    include_once "footer.inc.php";
?>