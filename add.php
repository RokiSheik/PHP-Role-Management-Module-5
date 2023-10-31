<?php
session_name("Myapp");
session_start();
if(!isset($_SESSION['login'])){
  header('location: login.php');
}

  if($_SESSION['Role'] == 'User'){
    header('location: user.php');
  }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Create</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="page-header text-center mb-3">Add New User</h1>
    <div class="row">
        <div class="col-1"></div>       
        <form method="POST">         
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">UserName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="UserName" name="UserName">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Email" name="Email">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="Password" name="Password">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                <select id="Role" name="Role" class="form-select" aria-label="Default select example">
                  <option value="Admin">Admin</option>
                  <option value="Manager">Manager</option>
                  <option value="User">User</option>
                </select>
                </div>
            </div>
            <input type="submit" name="save" value="Save" class="btn btn-primary">
        </form>
        </div>
        <div class="col-5"></div>
    </div>
</div>    
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
            'Role'  => $_POST['Role'],
        );
 
        $data[] = $input;
        $data = json_encode($data, JSON_PRETTY_PRINT );
        file_put_contents('member.json', $data);
        
        if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Admin'){
            header('location: admin.php');
          }
           if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Manager'){
            header('location: manager.php');
          }
    }
?>
</body>
</html>