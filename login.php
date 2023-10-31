<?php
session_name("Myapp");
session_start();


if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Admin'){
  header('location: admin.php');
}
 if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Manager'){
  header('location: manager.php');
}
if( isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'User'){
  header('location: user.php');
}

$data = file_get_contents('member.json');
$data = json_decode($data, true);
$error = false;
if(isset($_POST['submit'])){
if (isset($_POST['Email']) && isset($_POST['Password'])) {
 foreach($data as $row){
    if($row['Email'] == $_POST['Email'] && $row['Password'] == md5($_POST['Password'])){     
      $_SESSION['Role'] = $row['Role']; 
      $_SESSION['UserName'] = $row['UserName']; 
      $_SESSION['Email'] = $row['Email']; 
      $_SESSION['login'] = true;

      if($_SESSION['Role'] == 'Admin'){
        header('location: admin.php');
      }
       if($_SESSION['Role'] == 'Manager'){
        header('location: manager.php');
      }
      if($_SESSION['Role'] == 'User'){
        header('location: user.php');
      }
     
    }
    else{
      $error = true;
      $_SESSION['UserName'] = false;
      $_SESSION['Role'] = false;
      $_SESSION['login'] = false;
    }    
 }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="Email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="Password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>           
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-4">
            <?php if($error){
                 echo "<p class='link-danger'>Email and Password Do not Match </p>";
              } ?>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button><br>
            <p class="text-center">OR</p>
            
              <div class="regbtn">
              <p class="btn btn-primary btn-lg"> <a href="register.php"
              class="link-danger"> Register</a></p>
              </div>
            
          </div>

        </form>
      </div>
    </div>
  </div>
  
</section>
</body>
</html>
