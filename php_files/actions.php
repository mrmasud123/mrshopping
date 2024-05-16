<?php
include '../config/Database.php';
$db=new Database();
//echo json_encode(array('error'=>'Username Foeld is Empty.')); exit;
    if(isset($_POST['login'])){
        $db->select('user');
        $result=$db->getResult();

        $email=$db->escapeString($_POST['name']);
        $password=$db->escapeString($_POST['pass']);
        $db->select('user','*',null,"email='$email' AND password='$password'");
        $res=$db->getResult();
        if(count($res)>0){
            session_start();
            $_SESSION['id']=$res[0]['user_id'];
            $_SESSION['user_role']="user";
            $_SESSION['userEmail']=$email;
            $_SESSION['userName']=$res[0]['f_name'];
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("error"=>"E-mail or password is wrong"));
        }
    }

    if(isset($_POST['registration'])){
        $fullname=$db->escapeString($_POST['fullname']);
        $password=$db->escapeString($_POST['pass']);
        $mobile=$db->escapeString($_POST['mobile']);
        $email=$db->escapeString($_POST['email']);

        if(empty($fullname)){
            echo json_encode(array("error"=>"Name field can not be empty")); exit;
        }else if(empty($password)){
            echo json_encode(array("error"=>"Password field can not be empty"));exit;
        }else if(empty($mobile)){
            echo json_encode(array("error"=>"Mobile field can not be empty"));exit;
        }else if(empty($email)){
            echo json_encode(array("error"=>"E-mail field can not be empty")); exit;
        }else{
            $db->select('user','email');
            $existingEmail=$db->getResult()[0]['email'];
            if($existingEmail==$email){
                echo json_encode(array('error'=>'Email exists')); exit;
            }else{
                $db->insert('user',['f_name'=>$fullname,'email'=>$email,'password'=>$password,'mobile'=>$mobile ]);
                $result=$db->getResult();
                session_start();
                $_SESSION['userEmail']=$email;
                $_SESSION['userName']=$fullname;
                $_SESSION['user_role']="user";
                echo json_encode(array('success'=>1));
            }
        }

        

    }

    if(isset($_POST['user_logout'])){
        session_start();
	    /* remove all session variables */
	    session_unset();
	    /* destroy the session */
	    session_destroy();

	    echo 'true'; exit;
    }

    if(isset($_POST['modify'])){
        $name=$db->escapeString($_POST['name']);
        $mobile=$db->escapeString($_POST['mobile']);
        $email=$db->escapeString($_POST['email']);
        $id=$db->escapeString($_POST['user_id']);

        if(empty($name)){
            echo json_encode(array("error"=>"Name field can not be empty")); exit;
        }else if(empty($email)){
            echo json_encode(array("error"=>"Email field can not be empty"));exit;
        }else if(empty($mobile)){
            echo json_encode(array("error"=>"Mobile field can not be empty"));exit;
        }else{
            $db->update('user',['f_name'=>$name, 'email'=>$email, 'mobile'=>$mobile], "user_id='$id'");
            $res=$db->getResult();
            if(count($res)>0){
                echo json_encode(array('success'=>1));
            }else{
                echo json_encode(array('error'=>"Updation failed"));
            }
        }
    }

    if(isset($_POST['change_password'])){
        
        $oldPass=$db->escapeString($_POST['oldPass']);
        $newPass=$db->escapeString($_POST['newPass']);
        $id=$db->escapeString($_POST['id']);

        $db->select('user','password',null,"user_id='$id'");
        $res=$db->getResult();
        $currentPass=$res[0]['password'];
        if(empty($oldPass)){
            echo json_encode(array("error"=>"Old Password can not be empty")); exit;
        }else if(empty($newPass)){
            echo json_encode(array("error"=>"New Password can not be empty"));exit;
        }else{
            if($currentPass!=$oldPass){
                echo json_encode(array("error"=>"Old password does not match"));exit;
            }else{
                $db->update('user',['password'=>$newPass],"user_id='$id'");
                $result=$db->getResult();
                if(count($result)>0){
                    echo json_encode(array('success'=>1));
                }
            }
        }
    }

    if(isset($_POST['addToCart'])){
        session_start();
        if($_POST['isLoggedIn'] == 0 ){
            echo json_encode(array("error"=>0));
        }else{
            $pid=$db->escapeString($_POST['id']);
            
            $logged_email=$_SESSION['userEmail'];
            $db->select('user','user_id',null,"email='$logged_email'");
            $res=$db->getResult();
            $user_id=$res[0]['user_id'];

            $db->select('product_cart',"*",null,"p_id='$pid'");
            $existingPrd=$db->getResult();
            if(!empty($existingPrd)){
                $db->select('product_cart',"*",null,"user_id='$user_id'");
                $totalItemInCart=count($db->getResult());
                echo json_encode(array("success"=>1,"totalItem"=>$totalItemInCart));
            }else{
                $db->insert('product_cart',['p_id'=>$pid,'user_id'=>$user_id]);
                $result=$db->getResult();
                if(count($result)>0){
                    $db->select('product_cart',"*",null,"user_id='$user_id'");
                    $totalItemInCart=count($db->getResult());
                    echo json_encode(array("success"=>1,"totalItem"=>$totalItemInCart));
                }else{
                    echo json_encode(array("error"=>1));
                }
            }
            
        }
    }

    if(isset($_POST['addToWishlist'])){
        session_start();
        if($_POST['isLoggedIn'] == 0 ){
            echo json_encode(array("error"=>0));
        }else{
            $pid=$db->escapeString($_POST['id']);
            $logged_email=$_SESSION['userEmail'];
            $db->select('user','user_id',null,"email='$logged_email'");
            $res=$db->getResult();
            $user_id=$res[0]['user_id'];

            $db->select('tmp_wishlist',"*",null,"p_id='$pid'");
            $existingWishlist=$db->getResult();
            if(!empty($existingWishlist)){
                $db->select('tmp_wishlist',"*",null,"user_id='$user_id'");
                $totalItemInWishlist=count($db->getResult());
                echo json_encode(array("success"=>1,"totalItem"=>$totalItemInWishlist));
            }else{
                $db->insert('tmp_wishlist',['user_id'=>$user_id,'p_id'=>$pid]);
                $result=$db->getResult();
                if(count($result)>0){
                    $db->select('tmp_wishlist',"*",null,"user_id='$user_id'");
                    $totalItemInWishlist=count($db->getResult());
                    echo json_encode(array("success"=>1,"totalItem"=>$totalItemInWishlist));
                }else{
                    echo json_encode(array("error"=>1));
                }
            }
            
        }
        
    }

    if(isset($_POST['cartCount']) || isset($_POST['totalWishList'])){
        session_start();
        $logged_email=$_SESSION['userEmail'];
            $db->select('user','user_id',null,"email='$logged_email'");
            $res=$db->getResult();
            $user_id=$res[0]['user_id'];
            $db->select('product_cart',"*",null,"user_id='$user_id'");
            $totalItemInCart=count($db->getResult());

            $db->select('tmp_wishlist',"*",null,"user_id='$user_id'");
            $totalWishCount=count($db->getResult());
            echo json_encode(array("totalItem"=>$totalItemInCart,"totalWishCount"=>$totalWishCount));
    }

    if(isset($_POST['removeWishList'])){
        $pid=$_POST['pid'];
        $db->delete('tmp_wishlist',"p_id='$pid'");
        $res=$db->getResult();
        if(count($res)>0){
            echo json_encode(array("success"=>1));
        }
    }
   
    if(isset($_POST['removeCartItem'])){
        $pid=$_POST['pid'];
        $db->delete('product_cart',"p_id='$pid'");
        $res=$db->getResult();
        if(count($res)>0){
            echo json_encode(array("success"=>1));
        }
    }

    if(isset($_POST['address_update'])){
        session_start();
        $current_user=$_SESSION['id'];
        $u_city=$_POST['u_city'];
        $u_address=$_POST['u_address'];
        $db->update('user',['address'=>$u_address,'city'=>$u_city],"user_id=$current_user");
        if($db->getResult()){
            echo json_encode(array('success'=>1));
        }else{
            echo json_encode(array('error'=>0));
        }
    }

?>