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
    $title=$name." - Cart";
    include_once "header.inc.php";
    $db->select('user','address,city',null,"email='$loggedEmail'");
    $user_data=$db->getResult();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-2 display-6 text-center"><?php echo $name ?>'s Cart</h4>
            <table class="table table-stripped">
                <tr>
                    <th>Product image</th>
                    <th>Product Name</th>
                    <th>product Price</th>
                    <th>Qty</th>
                    <th>Sub total</th>
                    <th>Action</th>
                </tr>
                <?php
                $current_user=$_SESSION['id'];
                    $db->select('product_cart',"*",null,"user_id=$current_user");
                    $wishlist=$db->getResult();
                    if(count($wishlist)>0){
                        foreach($wishlist as $wish){
                            $pid=$wish['p_id'];
                            $db->select("products","*",null,"product_id='$pid'");
                            $single_prd=$db->getResult();
                           
                    ?>
                <tr>
                    <td class="p-2"><img src="images/<?php echo $single_prd[0]['featured_image'] ?>" style="border-radius:50%;width:150px;height:150px" alt=""></td>
                    <td class="p-2"><?php echo $single_prd[0]['product_title'] ?> </td>
                    <td class="p-2"><?php echo $single_prd[0]['product_price'] ?> Tk.</td>
                    <td>
                        <input class="form-control item-qty" type="number" value="1"/>
                        <input type="hidden" class="item-id" value="<?php echo $single_prd[0]['product_id']; ?>"/>
                        <input type="hidden" class="item-price" value="<?php echo $single_prd[0]['product_price'];?>"/>
                    </td>
                    <td class="showtotal" style="width: 150px;"><?php echo $currency_format; ?> <span class="sub-total"><?php echo $single_prd[0]['product_price']; ?></span></td>
                    <td class="p-2"><a class="btn btn-sm btn-primary " ><i data-id="<?php echo $single_prd[0]['product_id'] ?>" class="fa fa-remove text-light remove-cart-item"></i></a></td>
                </tr>
                
                    <?php
                        }
                    }
                    ?>
                    <tr>
                    <td colspan="5" align="right"><b>TOTAL AMOUNT <?php echo $currency_format; ?></b></td>
                    <td class="total-amount">256000</td>
                </tr>
            </table>
            <div class="uaddress-info">
                <?php
                    if(empty($user_data[0]['address']) || empty($user_data[0]['city'])){
                        echo '<p class="text-light bg-danger rounded w-50 p-2">No Default Address found</p>';
                        echo '<button class="address-btn btn btn-sm btn-primary">Click to add address <i class="fa fa-arrow-down"></i></button>';
                    }else{
                        echo "<p class='text-light bg-success rounded w-50 p-2'>Address : ".ucfirst($user_data[0]['address']).",".ucfirst($user_data[0]['city'])."</p>";
                        echo '<button class="update-address-btn btn btn-sm btn-primary">Click to update address <i class="fa fa-arrow-down"></i></button>';
                    }
                ?>
                <div class="update_user_address w-25 mt-2">
                    <form action="" id="update-user-address-form">
                        <div class="form-group">
                            <input type="text" placeholder="Enter address..." class="updated_address form-control">
                            <input type="text" placeholder="Enter city..." class="updated_city form-control">
                        </div>
                        <button class="btn btn-primary btn-sm mt-2">Update?</button>
                    </form>
                </div>
                <div class="user_address w-25 mt-2">
                    <form action="" id="user-address-form">
                        <div class="form-group">
                            <input type="text" placeholder="Enter address..." class="form-control">
                            <input type="text" placeholder="Enter city..." class="form-control">
                        </div>
                        <button class="btn btn-primary btn-sm mt-2">Add?</button>
                    </form>
                </div>
            </div>
            <div class="buttons d-flex align-items-center justify-content-between">
                <button class="btn btn-sm btn-info"><a href="<?php echo $db->hostname ?>" class="nav-link text-light">Continue shopping?</a></button>
                <button class="btn btn-sm btn-primary"><a href="cart.php" class="nav-link text-light">Proceed to checkout?</a></button>
            </div>
        </div>
    </div>
</div>
<?php
    include_once "footer.inc.php";
?>