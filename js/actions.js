$(document).ready(function(){

    $(".address-btn").click(function(){
        $(".user_address").css('display','block');
        $("i.fa.fa-arrow-down").css('transform','rotate(180deg)');
    });

    $(".update-address-btn").click(function(){
        $(".update_user_address").css('display','block');
        $("i.fa.fa-arrow-down").css('transform','rotate(180deg)');
    });

    //Sidebar setting
    $("#login_request").click(function(){
        console.log("Request");
        $("#sidebar").css("transition","0.5s");
        $("#sidebar").css("right","-50%");
        $("#lg_modal").css("transition","0.5s");
        $("#lg_modal").css("top","0");
    });
    $("#loginClose").click(function(){
        $("#lg_modal").css("transition","0.5s");
        $("#lg_modal").css("top","-300%");
    });

    //User login 
    $("#loginUser").submit(function(e){
        e.preventDefault();
        $name=$(".username").val();
        $pass=$(".password").val();
        console.log($name,$pass);
            $.ajax({
                url:'php_files/actions.php',
                method:'post',
                data:{login:1,name:$name,pass:$pass},
                dataType:'json',
                success:function($response){
                    $data=$response;
                    console.log($data);
                    if($data.success==1){
                        location.reload();
                    }else{
                        $('#loginUser').append('<div class="msg text-center alert alert-danger p-0">'+$data.error+'</div>');
                        setTimeout(function(){ $('.msg').remove(); }, 1000);
                    }
                    
                }
            });
    });

    //Register New user
    $("#regUser").submit(function(e){
        e.preventDefault();
        $name=$(".fullname").val();
        $email=$(".email").val();
        $pass=$(".password").val();
        $mobile=$(".mobile").val();
        console.log($name,$pass);
            $.ajax({
                url:'php_files/actions.php',
                method:'post',
                data:{registration:1,fullname:$name,pass:$pass, email:$email, mobile:$mobile},
                dataType:'json',
                success:function($response){
                    $data=$response;
                    if($data.success==1){
                        location.href="index.php";
                    }else{
                        $('form').append('<div class="msg text-center alert alert-danger p-2">'+$data.error+'</div>');
                        setTimeout(function(){ $('.msg').remove(); }, 2000);
                    }
                    
                }
            });
    });

    //User logout
    $(".user_logout").click(function(){
        $user_logout=1;
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{user_logout:$user_logout},
            success:function($response){
                if($response=='true'){
                    location.reload();
                }
            }
        });
    });

    //Modify Password
    $("#modify-user").submit(function(e){
        e.preventDefault();

        $name=$(".fullname").val();
        $email=$(".email").val();
        $mobile=$(".mobile").val();
        $id=$(".user_id").val();
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{modify:1,name:$name,email:$email,mobile:$mobile,user_id:$id},
            dataType:'json',
            success:function($response){
                $data=$response;
                if($data.success==1){
                    location.href="user-profile.php";
                }else{
                    $('#modify-user').append('<div class="mt-5 msg text-center alert alert-danger p-2">'+$data.error+'</div>');
                    setTimeout(function(){ $('.msg').remove(); }, 2000);
                }
            }
        });
    });

    //Change Password
    $("#change-password").submit(function(e){
        e.preventDefault();
        $newPass=$(".newPass").val();
        $oldPass=$(".oldPass").val();
        $id=$(".user_id").val();
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{newPass:$newPass,oldPass:$oldPass,id:$id,change_password:1},
            dataType:'json',
            success:function($response){
                $data=$response;
                if($data.success==1){
                    location.href="user-profile.php";
                }else{
                    $('#change-password').append('<div class="mt-5 msg text-center alert alert-danger p-2">'+$data.error+'</div>');
                    setTimeout(function(){ $('.msg').remove(); }, 2000);
                }
            }
        });
    });

    //Getting the total product in cart
    $isLoggedIn=$(".isLoggedin").val();
    if($isLoggedIn==1){
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{cartCount:1,totalWishList:1},
            dataType:'json',
            success:function($data){
                $response=$data;
                $("#totalCart").text($response.totalItem);
                $("#totalWishList").text($response.totalWishCount);
                console.log($response);
            }
        });     
    }

    //Adding product to cart
    $(".add-to-cart").click(function(e){
        e.preventDefault();
        $isLoggedIn=$(".isLoggedin").val();

        $prod_id = $(this).attr('data-id');
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{addToCart:1,id:$prod_id,isLoggedIn:$isLoggedIn},
            dataType:'json',
            success:function($response){
                $data=$response;
                if($data.success==1){
                    $(".message").text("Product Added !!");
                    $(".message").css("backgroundColor","green");
                    $(".message").css("display","block");
                    setTimeout(function(){ $('.message').css("display","none") }, 2000);
                    $("#totalCart").text($data.totalItem);
                }else{
                    if($data.error==1){
                        $(".message").text("Product can not Added !!");
                        $(".message").css("backgroundColor","red");
                        $(".message").css("display","block");
                        setTimeout(function(){ $('.message').css("display","none") }, 2000);
                    }else{
                        $(".message").text("Please Login first !!");
                        $(".message").css("backgroundColor","red");
                        $(".message").css("display","block");
                        setTimeout(function(){ $('.message').css("display","none") }, 2000);
                    }
                   
                    
                }
                
            }
        });
    });

    //Adding product to wishlist
    $(".add-to-wishlist").click(function(e){
    e.preventDefault();
    $isLoggedIn=$(".isLoggedin").val();

    $prod_id = $(this).attr('data-id');
    $.ajax({
        url:'php_files/actions.php',
        method:'post',
        data:{addToWishlist:1,id:$prod_id,isLoggedIn:$isLoggedIn},
        dataType:'json',
        success:function($response){
            $data=$response;
            if($data.success==1){
                $(".message").text("Added to wishlist !!");
                $(".message").css("backgroundColor","green");
                $(".message").css("display","block");
                setTimeout(function(){ $('.message').css("display","none") }, 2000);
                $("#totalWishList").text($data.totalItem);
            }else{
                if($data.error==1){
                    $(".message").text("Wishlist can not added!!");
                    $(".message").css("backgroundColor","red");
                    $(".message").css("display","block");
                    setTimeout(function(){ $('.message').css("display","none") }, 2000);
                }else{
                    $(".message").text("Please Login first !!");
                    $(".message").css("backgroundColor","red");
                    $(".message").css("display","block");
                    setTimeout(function(){ $('.message').css("display","none") }, 2000);
                }
               
                
            }
            
        }
    });
    });

    $(".remove-wishlist-item").click(function(e){
        $pid=$(this).attr('data-id');
        $.ajax({
            url:"php_files/actions.php",
            method:'post',
            data:{removeWishList:1,pid:$pid},
            dataType:'json',
            success:function($response){
                $data=$response;
                if($data.success==1){
                    $(".message").text("Product Removed !!");
                    $(".message").css("backgroundColor","green");
                    $(".message").css("right","5px");
                    setTimeout(function(){ $('.message').css("display","none") }, 2000);
                    location.reload();
                }
            }
        });
    });
   
    $(".remove-cart-item").click(function(e){
        $pid=$(this).attr('data-id');
        $.ajax({
            url:"php_files/actions.php",
            method:'post',
            data:{removeCartItem:1,pid:$pid},
            dataType:'json',
            success:function($response){
                $data=$response;
                if($data.success==1){
                    $(".message").text("Product Removed !!");
                    $(".message").css("backgroundColor","green");
                    $(".message").css("display","block");
                    setTimeout(function(){ $('.message').css("display","none") }, 2000);
                    location.reload();
                }
            }
        });
    });



    function total_amount(){
        $amount=0;
        $('.sub-total').each(function(){
            $item_price=parseInt($(this).html());
            $amount+=$item_price;
        });
        console.log($amount);
        $('.total-amount').html($amount);
    }
    total_amount();

    $('.item-qty').change(function(){
        $qty = $(this).val();
        if($qty>=0){
            $price = $(this).siblings('.item-price').val();
            $new_price = ($qty * $price);
            $(this).parent().children().siblings().parent().siblings('.showtotal').children('.sub-total').html($new_price);
            total_amount();
        }else{
            $(".message").text("Product can not be less than zero !!");
            $(".message").css("backgroundColor","red");
            $(".message").css("display","block");
            setTimeout(function(){ $('.message').css("display","none") }, 2000);
        }
    });

    $("#update-user-address-form").submit(function(e){
        e.preventDefault();
        
        $updated_city=$('.updated_city').val();
        $update_address=$('.updated_address').val();
        console.log($update_address,$updated_city);
        $.ajax({
            url:'php_files/actions.php',
            method:'post',
            data:{address_update:1,u_city:$updated_city,u_address:$update_address},
            dataType:'JSON',
            success:function($data){
                $response=$data;
                if($response.success==1){
                    console.log("Data updated");
                }else{
                    console.log("Failed");
                }
            }
        });
    });
});