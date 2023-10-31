<?php
session_name("Myapp");
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
 <!-- Section: Design Block -->
<section class="text-center text-lg-start">
  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Sign up now</h2>
            <form method="POST" >       
                  <div class="form-outline mb-4">
                    <input type="text" name="UserName" id="form3Example1" class="form-control" placeholder="Enter Your Name" />
                  </div>
              <div class="form-outline mb-4">
                <input type="email" name="Email" id="form3Example3" class="form-control" placeholder="Enter Your Email" />   
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="Password" id="form3Example4" class="form-control" placeholder="Enter Your Password"/>
              </div>
              <button type="submit" name="save" class="btn btn-primary btn-block mb-4">
                Sign up
              </button>
              <div class="text-center text-lg-start mt-4 pt-2">
               <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php"
                class="link-danger">Login</a></p>
          </div>              <!-- Register buttons -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
    if(isset($_POST['save'])){
        //open the json file
        $data = file_get_contents('member.json');
        $data = json_decode($data,true);
        //data in out POST
        $input = array(
            'UserName' => $_POST['UserName'],
            'Email' => $_POST['Email'],
            'Password' => md5($_POST['Password']),
            'Role'  => "User",
        );
        //append the input to our array
        $data[] = $input;
        //encode back to json
        $data = json_encode($data, JSON_PRETTY_PRINT );
        file_put_contents('member.json', $data);
        header('location: login.php');
    }
?>
</body>
</html>
