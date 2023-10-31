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
        <div class="login-box">
          <h1>Welcome to Our Website</h1>
          <p>Please log in or register to continue.</p>
          <div class="button-container">
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>

