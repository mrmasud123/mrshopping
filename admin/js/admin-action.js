$(document).ready(function(){
console.log("Jquery");
$("#toggleAdmin").click(function(){
  $(".options").toggleClass("sh");
});
    //admin login
    $("#login-form").submit(function(e){
        e.preventDefault();
        $email=$('.email').val();
        $pass=$('.pass').val();
        console.log($email,$pass);
      $.ajax({
        url:'php_files/actions.php',
        method:'post',
        data:{adminLogin:1,email:$email,pass:$pass},
        dataType:'json',
        success:function($response){
            $data=$response;
            if($data.success==1){
                $('form').append("<div class='rounded text-light mt-3 bg-success p-2'>Login Success</div>");
                setTimeout(()=>{
                    location.href="index.php";
                }, 2000);
            }else{
                $('form').append("<div class='bg-danger p-2 rounded mt-3 alertMsg'>"+$data.error+"</div>");
                setTimeout(function(){ $('.alertMsg').remove(); }, 1000);
            }
        }
      });
    });


    //Update product
    $('#updateProduct').submit(function(e){
      e.preventDefault();
      $title = $('.product_title').val();
      $cat = $('.product_category option:selected').val();
      $sub_cat = $('.product_sub_category option:selected').val();
      $des = $('.product_description').val();
      $price = $('.product_price').val();
      $qty = $('.product_qty').val();
      $status = $('.product_status').val();
      $image = $('.product_image').val();
      $old_image = $('.old_image').val();
          $formdata = new FormData(this);
          $formdata.append('update',1);
          $.ajax({
              url    : "php_files/product-actions.php",
              type   : "POST",
              data   : $formdata,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function($response){
                  $res =$response;
                  console.log($res);
                  if($res.success==1){
                    $('#updateProduct').prepend('<div class="alert alert-success">Updated successfully</div>');
                    setTimeout(()=>{
                      $("#updateProduct").children(".alert").remove();
                    },2000);
                    location.href="index.php";
                  }else{
                    $('#updateProduct').prepend('<div class="alert alert-danger">'+$res.error+'</div>');
                    setTimeout(()=>{
                      $("#updateProduct").children(".alert").remove();
                    },2000);
                  }
              }
          });
      /* } */

    });


    //
    $(".product_category").change(function(){
      $cat_id=$(".product_category option:selected").val();
      console.log($cat_id);
      $.ajax({
        url:'php_files/product-actions.php',
        method:'post',
        data:{cat:1,catId:$cat_id},
        dataType:'json',
        success:function($response){
          //sub_category loading
          $sub_cat = '<option value="" selected disabled>Select Sub Category</option>';
          $total_sub_cat=$response.sub_category.length;
          for($a=0; $a<$total_sub_cat; $a++){
            $sub_cat+='<option value='+$response.sub_category[$a].sub_cat_id+'>'+$response.sub_category[$a].sub_cat_title+'</option>';
          }
          $(".product_sub_category").html($sub_cat);
         

          //brands  loading
          $brand = '<option value="" selected disabled>Select Brand</option>';
          $total_brand=$response.brands.length;
          for($i=0; $i<$total_brand; $i++){
            $brand+='<option value='+$response.brands[$i].brand_id+'>'+$response.brands[$i].brand_title+'</option>';
          }
          $(".product_brands").html($brand);
          console.log($brand);
        }
      });
    });

    //
    $('#createProduct').submit(function(e){
      e.preventDefault();
      console.log("Create");
      var title = $('.product_title').val();
      var cat = $('.product_category option:selected').val();
      var sub_cat = $('.product_sub_category option:selected').val();
      var des = $('.product_description').val();
      var price = $('.product_price').val();
      var qty = $('.product_qty').val();
      var status = $('.product_status').val();
      var image = $('.product_image').val();

      $formdata = new FormData(this);
      $formdata.append('addProduct',1);
      $.ajax({
        url:'php_files/product-actions.php',
        method:"POST",
        processData: false,
        contentType: false,
        data:$formdata,
        dataType:'json',
        success:function($response){
          $res =$response;
          console.log($res);
          if($res.success==1){
            $('#createProduct').prepend('<div class="alert alert-success">Added successfully</div>');
            setTimeout(()=>{
              $("#createProduct").children(".alert").remove();
            },2000);
            location.href="index.php";
          }else{
            $('#createProduct').prepend('<div class="alert alert-danger">'+$res.error+'</div>');
            setTimeout(()=>{
              $("#createProduct").children(".alert").remove();
            },2000);
          }
        }
      });

    });

    //product delete
    $('.admin_delete').click(function(e){
      $prod_id = $(this).attr('data-id');
      console.log($prod_id);
      $.ajax({
        url:'php_files/product-actions.php',
        method:'POST',
        data:{prd_delete:1,prd_id:$prod_id},
        dataType:'json',
        success:function($response){
          $data=$response;
          if($data.success==1){
            location.reload();
          }
        }
      });
    });

    //create category
    $("#createCategory").submit(function(e){
      e.preventDefault();
      $formdata=new FormData(this);
      $formdata.append('create_cat',1);
      $.ajax({
        url:'php_files/actions.php',
        method:'POST',
        processData: false,
        contentType: false,
        data:$formdata,
        dataType:'json',
        success:function($response){
          $data=$response;
          if($data.success==1){
            location.href="category.php";
          }else{
            $('#createCategory').append('<div class="mt-3 alert alert-danger">'+$data.error+'</div>');
            setTimeout(()=>{
              $("#createCategory").children(".alert").remove();
            },2000);
          }
        }
      }); 
    });

    //delete category
    $(".delete_category").click(function(e){
      e.preventDefault();
      $decision=confirm("If you delete a category , the products and sub category of this category will also be deleted.Do you want to delete the category?");
      $prd_id=$(this).attr('data-id');
      if($decision){
        $.ajax({
          url:'php_files/actions.php',
          method:'POST',
          data:{delete_cat:1,prd_id:$prd_id},
          dataType:'json',
          success:function($response){
            $data=$response;
            console.log($data);
            if($data.success==1){
              location.reload();
            }else{
              alert("Category could not delete");
            }
          }
          });
      }
      
    });

    //update category
    $("#updateCategory").submit(function(e){
      e.preventDefault();
      $formdata=new FormData(this);
      $formdata.append("updateCategory",1);
      $.ajax({
        url:'php_files/actions.php',
        method:'POST',
        processData: false,
        contentType: false,
        data:$formdata,
        dataType:'json',
        success:function($response){
          $data=$response;
          console.log($data);
          if($data.success==1){
            location.href="category.php";
          }else{
            $('#updateCategory').append('<div class="mt-3 alert alert-danger">'+$data.error+'</div>');
            setTimeout(()=>{
              $("#updateCategory").children(".alert").remove();
            },2000);
          }
        }
      });
    });

    $("#createSubCategory").submit(function(e){
      e.preventDefault();
      $formdata=new FormData(this);
      $formdata.append('createCategory',1);
      $.ajax({
        url:'php_files/actions.php',
        method:'post',
        contentType:false,
        processData:false,
        data:$formdata,
        dataType:'json',
        success:function($response){
          $data=$response;
          console.log($data);
          if($data.success==1){
            $('#createSubCategory').append('<div class="mt-3 alert alert-success">Sub category added</div>');
            setTimeout(()=>{
              location.href="sub-category.php";
            },1500);
          }else{
            $('#createSubCategory').append('<div class="mt-3 alert alert-danger">'+$data.error+'</div>');
            setTimeout(()=>{
              $("#createSubCategory").children(".alert").remove();
            },2000);
          }
        }
      });
    });

    $("#updateSubCategory").submit(function(e){
      e.preventDefault();
      $formdata=new FormData(this);
      $formdata.append('updateSubCat', 1);
      $.ajax({
        url:'php_files/actions.php',
        method:'post',
        contentType:false,
        processData:false,
        data:$formdata,
        dataType:'JSON',
        success:function($response){
          $data=$response;
          if($data.success==1){
            location.href='sub-category.php';
          }
          
        }
      });
    });

    $(".showCat_Header").change(function(e){
      $sub_cat_id=$(this).attr('data-id');
      $status='';
      if($(this).prop("checked")){
       $status='1';
      }else if(!$(this).prop("checked")){
        $status='0';
      }
      $.ajax({
        url:'php_files/actions.php',
        method:'post',
        data:{showHead:1,status:$status,sub_cat_id:$sub_cat_id},
        success:function($response){
          //alert("product will be shown in header");
        }
      });
    });


    $(".showCat_Footer").change(function(e){
      $sub_cat_id=$(this).attr('data-id');
      $status='';
      if($(this).prop("checked")){
       $status='1';
      }else if(!$(this).prop("checked")){
        $status='0';
      }
      $.ajax({
        url:'php_files/actions.php',
        method:'post',
        data:{showFoot:1,status:$status,sub_cat_id:$sub_cat_id},
        success:function($response){
          //alert("product will be shown in header");
        }
      });
    });

    $(".logout").click(function(e){
      e.preventDefault();
      $.ajax({
        url:'php_files/actions.php',
        data:{admin_logout:1},
        method:'POST',
        success:function($response){
          console.log($response);
          if($response){
            alert("Successfully logged out");
            setTimeout(function(){
              location.href='login.php';
            },500);
          }
         
        }
      });
    });
  });