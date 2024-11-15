<?php 
  session_start();
  if(isset($_SESSION['admin_id'])){
    header("location: index.php");
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    
    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-between align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="images/shopping-login.png"
                class="img-fluid" alt="Sample image">
            </div>
             <!-- login start -->
             <div id="l-form" class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <form id="login-form">
      
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <h1 class="display-4 text-bold">Admin Login</h1>
                  <input name="email" type="email" id="form3Example3" class="email form-control form-control-lg"
                    placeholder="Enter a valid email address" />
                  <label class="form-label" for="form3Example3">Email address</label>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-3">
                  <input name="password" type="password" id="form3Example4" class="pass form-control form-control-lg"
                    placeholder="Enter password" />
                  <label class="form-label" for="form3Example4">Password</label>
                </div>
      
                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Remember me
                    </label>
                  </div>
                  <a href="#!" class="text-body">Forgot password?</a>
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button name="login" type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" id="loginBtn">Login</button>
                </div>
              </form>
            </div>
            <!-- login end -->
          </div>
        </div>
      </section>
<div class="message">
  <strong id="msg"></strong>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/admin-action.js"></script>
</body>
</html>