<?php 
include_once '../../config/Database.php';
$db = new Database();

//product update
if(isset($_POST['update'])){
	if(!isset($_POST['product_id']) || empty($_POST['product_id'])){
		echo json_encode(array('error'=>'Product ID is missing.')); exit;
	}elseif(!isset($_POST['product_title']) || empty($_POST['product_title'])){
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
		echo json_encode(array('error'=>'Status Field is Empty.')); exit;
	}else if(empty($_POST['old_image']) && empty($_FILES['new_image']['name'])){
        echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{
        
        if(!empty($_POST['old_image']) && empty($_FILES['new_image']['name'])){
            $file_name = $_POST['old_image']; 
        }else if(empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
            
            $file_name=$_FILES['new_image']['name'];
            $tmp_ext=explode(".", $file_name);
            $file_ext=strtolower(end($tmp_ext));
            $img_format=array("jpeg","png","jpg");
            $file_tmp = $_FILES['new_image']['tmp_name'];
            $file_name=time().$file_name;
            if(!in_array($file_ext,$img_format)){
                echo json_encode(array('error'=>"Image extension not valid")); exit;
            }
            
        }else if(!empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
            $file_name=$_FILES['new_image']['name'];
            $tmp_ext=explode(".", $file_name);
            $file_ext=strtolower(end($tmp_ext));
            $img_format=array("jpeg","png","jpg");
            $file_tmp = $_FILES['new_image']['tmp_name'];
            $file_name=time().$file_name;
            if(!in_array($file_ext,$img_format)){
                echo json_encode(array('error'=>"Image extension not valid")); exit;
            }
            unlink('../../images/'.$_POST['old_image']);
        }
        if(!isset($_POST['product_brand'])){
            $prd_brand="0";
        }else{
            $prd_brand=$_POST['product_brand'];
        }
        $params = [
            'product_title' => $db->escapeString($_POST['product_title']),
            'product_code' => uniqid(),
            'product_cat' => $db->escapeString($_POST['product_cat']),
            'product_sub_cat' => $db->escapeString($_POST['product_sub_cat']),
            'product_brand' => $db->escapeString($prd_brand),
            'featured_image' => $db->escapeString($file_name),
            'product_desc' => $db->escapeString($_POST['product_desc']),
            'product_price' => $db->escapeString($_POST['product_price']),
            'qty' => $db->escapeString($_POST['product_qty']),
            'product_status' => $db->escapeString($_POST['product_status'])
        ];

        $db->update('products',$params,"product_id='{$_POST['product_id']}'");
        $response = $db->getResult();
    		if(!empty($response)){

    			if(!empty($_FILES['new_image']['name'])){
    				
                    move_uploaded_file($file_tmp,"../../images/".$file_name);
                }
        		echo json_encode(array('success'=>1)); exit;
    		}
    }
}


//add product
if(isset($_POST['addProduct'])){

    if(!isset($_POST['product_title']) || empty($_POST['product_title'])){
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
		echo json_encode(array('error'=>'Status Field is Empty.')); exit;
	}elseif(!isset($_FILES['featured_img']['name']) || empty($_FILES['featured_img']['name'])){
		echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{
        if(isset($_FILES['featured_img'])){
        
        $file_name=$_FILES['featured_img']['name'];
        $tmp_ext=explode(".", $file_name);
        $file_ext=strtolower(end($tmp_ext));
        $img_format=array("jpeg","png","jpg");
        $file_tmp = $_FILES['featured_img']['tmp_name'];
        if(in_array($file_ext,$img_format)){
            $file_name=time().$file_name;
            if(!isset($_POST['product_brand'])){
                $prd_brand="0";
            }else{
                $prd_brand=$_POST['product_brand'];
            }

            $params = [
                'product_title' => $db->escapeString($_POST['product_title']),
                'product_code' => uniqid(),
        		'product_cat' => $db->escapeString($_POST['product_cat']),
        		'product_sub_cat' => $db->escapeString($_POST['product_sub_cat']),
        		'product_brand' => $db->escapeString($prd_brand),
        		'featured_image' => $db->escapeString($file_name),
        		'product_desc' => $db->escapeString($_POST['product_desc']),
        		'product_price' => $db->escapeString($_POST['product_price']),
                'qty' => $db->escapeString($_POST['product_qty']),
        		'product_status' => $db->escapeString($_POST['product_status'])
        	];
            

            $db->insert('products',$params);
            $insert_res=$db->getResult();
            if(count($insert_res)>0){
                $prd_qty=$_POST['product_qty'];
                $s=$db->sql("UPDATE categories SET products=products+'$prd_qty' where cat_id={$_POST['product_cat']}");
                    if($s){
                        
                        $st=$db->sql("UPDATE sub_categories SET cat_products=cat_products+'$prd_qty'where sub_cat_id={$_POST['product_sub_cat']}");
                        if($st){
                            move_uploaded_file($file_tmp,"../../images/".$file_name);
                            echo json_encode(array('success'=>1)); exit;
                        }else{
                            echo json_encode(array('error'=>'Unknown error occured.Try again')); exit;
                        }
                    }
            }
        }else{
            echo json_encode(array('error'=>'Image extension invalid')); exit;
        }
        
    }
}
}

if(isset($_POST['cat'])){
    $cat_id=$db->escapeString($_POST['catId']);
    $db->select('sub_categories','*',null,"cat_parent = $cat_id",null,null);
    $sub_category = $db->getResult();
    $output=array();
    if($sub_category>0){
        $output['sub_category']=$sub_category;
    }

    $db->select('brands','*',null,"brand_cat = $cat_id",null,null);
    $brands = $db->getResult();
    if ($sub_category > 0) {
        $output['brands'] = $brands;
    }

    echo json_encode($output);
}


if(isset($_POST['prd_delete'])){
    $prod_id=$_POST['prd_id'];
    $db->select('products',"*",null,"product_id='$prod_id'");
    $all_prod=$db->getResult();
    $prod_cat=$all_prod[0]['product_cat'];
    $prod_sub_cat=$all_prod[0]['product_sub_cat'];
    $db->delete('products',"product_id='$prod_id'");
    if(count($db->getResult())>0){
        $db->update('categories',['products'=>'products -1'],"cat_id='$prod_cat'");
        $response=$db->getResult();
        if(count($response)>0){
            $db->update('sub_categories',['cat_products'=>'cat_products -1'],"sub_cat_id='$prod_sub_cat'");
            if($db->getResult()){
                echo json_encode(array('success'=>1));
            }
        }
    }
}

?>