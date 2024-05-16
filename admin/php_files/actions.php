<?php
    include_once '../../config/Database.php';
    $db=new Database();
    if(isset($_POST['adminLogin'])){
        $email=$db->escapeString($_POST['email']);
        $pass=$db->escapeString($_POST['pass']);

        if(empty($email)){
            echo json_encode(array("error"=>"E-mail can not be empty"));
        }else if(empty($pass)){
            echo json_encode(array("error"=>"Password can not be empty"));
        }else{
            $db->select('admin',"*",null,"com_email='$email' and password='$pass'");
            $result=$db->getResult();
            if(count($result)>0){
                session_start();
                $_SESSION['admin_id']=$result[0]['admin_id'];
                $_SESSION['admin_email']=$result[0]['com_email'];
                echo json_encode(array("success"=>1));
            }else{
                echo json_encode(array("error"=>"Invalid E-mail or Password "));
            }
        }
        
    }

    //create category
    if(isset($_POST['create_cat'])){
        $cat_name=$db->escapeString($_POST['cat']);
        if(empty($cat_name)){
            echo json_encode(array('error'=>"Cat name empty"));
        }else{
            $db->select('categories','cat_title',null,"cat_title = '{$cat_name}'",null,null);
    		$exist = $db->getResult();
    		if(!empty($exist)){
    			echo json_encode(array('error'=>'Category Already exists.'));
    		}else{
				$db->insert('categories',array('cat_title'=>$cat_name));
				$response = $db->getResult();

				if(!empty($response)){
					echo json_encode(array('success'=>1));
				}
    		}
        }
    }

    //delete category
    if(isset($_POST['delete_cat'])){
        $cat_id=$_POST['prd_id'];
        $db->delete('products',"product_cat=$cat_id");
        $result=$db->getResult();
        if(count($result)>0){
            $db->delete('categories',"cat_id=$cat_id");
            $res=$db->getResult();
            if(count($res)>0){
                $db->delete('sub_categories',"cat_parent=$cat_id");
                if(count($db->getResult())>0){
                    echo json_encode(array('success'=>1));
                }
            }
        }
    }

    //update category
    if(isset($_POST['updateCategory'])){
        $c_id=$_POST['cat_id'];
        $c_name=$db->escapeString($_POST['cat_name']);
        if(empty($c_name)){
            echo json_encode(array('error'=>"Category can not be empty"));
        }else{
            $db->update('categories',["cat_title"=>"$c_name"],"cat_id=$c_id");
            if(count($db->getResult())>0){
                echo json_encode(array('success'=>1));
            }
        }
    }

    if(isset($_POST['updateSubCat'])){
        
        $sub_cat_name=$db->escapeString($_POST['sub_cat_name']);
        $new_prd_qty=$_POST['prd_qty'];
        $sub_cat_id=$_POST['cat_id'];
        $cat_parent_id=$_POST['cat_parent_id'];
        $total=0;
        $db->select('sub_categories','*',null,"cat_parent=$cat_parent_id");
        $sub_cat_parent=$db->getResult();
        foreach($sub_cat_parent as $parent){
            $total+=$parent['cat_products'];
        }
        if(empty($sub_cat_name)){
            echo json_encode(array('error'=>'Sub category can not be empty'));
        }else if($new_prd_qty<0){
            echo json_encode(array('error'=>'Product quantity can not be negative'));
        }else{
            $db->update('sub_categories',['sub_cat_title'=>$sub_cat_name,'cat_products'=>$new_prd_qty],"sub_cat_id=$sub_cat_id");
            if($db->getResult()){
                echo json_encode(array('success'=>1));
            }
            //echo $new_prd_qty ." ". $total;
        }
    }

    if(isset($_POST['createCategory'])){
        $sub_cat_title=$db->escapeString($_POST['sub_cat_name']);
        if(empty($_POST['parent_cat']) || !isset($_POST['parent_cat'])){
            echo json_encode(array('error'=>"Cat name empty"));
        }else if(empty($sub_cat_title)){
            echo json_encode(array('error'=>"Sub cat name empty"));
        }else{
            $db->select('sub_categories','sub_cat_title',null,"sub_cat_title = '{$sub_cat_title}'",null,null);
    		$exist = $db->getResult();
    		if(!empty($exist)){
    			echo json_encode(array('error'=>'Sub Category Already exists.'));
    		}else{
				$db->insert('sub_categories',array('sub_cat_title'=>$sub_cat_title, 'cat_parent'=>$_POST['parent_cat']));
				$response = $db->getResult();

				if(!empty($response)){
					echo json_encode(array('success'=>1));
				}
    		}
        }
    }

    if(isset($_POST['showHead'])){
        $sub_cat_id=$_POST['sub_cat_id'];
        $status=$_POST['status'];
        $db->update('sub_categories',['show_in_header'=>$status],"sub_cat_id=$sub_cat_id");
        if(count($db->getResult())>0){
            echo json_encode(array('success'=>1));
        }
    }

    if(isset($_POST['showFoot'])){
        $sub_cat_id=$_POST['sub_cat_id'];
        $status=$_POST['status'];
        $db->update('sub_categories',['show_in_footer'=>$status],"sub_cat_id=$sub_cat_id");
        if(count($db->getResult())>0){
            echo json_encode(array('success'=>1));
        }
    }

    if(isset($_POST['admin_logout'])){
        session_start();
        session_unset();
        session_destroy();
        echo 'true';
    }
?>