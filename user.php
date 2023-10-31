<?php
session_name("Myapp");
session_start();
if(!isset($_SESSION['login'])){
  header('location: login.php');
}

if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Admin'){
  header('location: admin.php');
}
 if(isset($_SESSION['Role'] ) && $_SESSION['Role'] == 'Manager'){
  header('location: manager.php');
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> User Dashboard  </title> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidebar">
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#profile">
          <i class='bx bx-user-circle ' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="#userlist">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">User list</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details"> 
        <a href="#profile" class="text-decoration-none">      
        <p class="admin_name  "> <i class='bx bx-user-circle  ' ></i> <?php    
         echo "<span class='text-end mb-2 h5  text-capitalize'>".$_SESSION['UserName']."</span>"  ?></p>
         </a>
      </div>
    </nav>
    <div class="home-content">
    <div class="container">
    <section  id="profile">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-12 col-lg-12 col-xl-12">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1 text-capitalize"><?php echo $_SESSION['UserName'] ?></h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?php echo $_SESSION['Role'] ?></p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">Email Address</p>
                    <p class="mb-0"><?php echo $_SESSION['Email'] ?></p>
                  </div>
                 
                 
                </div>              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
<?php
$data = file_get_contents('member.json');
//decode into php array
$data = json_decode($data);

$TotalList = count($data);
$TotalAdmin =0;
$TotalManager = 0;
$TotalUser = 0;
foreach($data as $row){
  if($row->Role == 'Admin')
  {
       $TotalAdmin++;
  }
  elseif($row->Role =='Manager'){
     $TotalManager++;
  }
  elseif($row->Role== 'User'){
    $TotalUser++;
}
}
    
?>

<div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic"> User List</div>
            <div class="number text-right"><?php echo $TotalUser ?></div>     
          </div>
        </div>
      </div>
</section>

<section id="userlist" >
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-12 col-lg-12 col-xl-12">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
          <div class="row">
              <div class="col-6"><h2>User List</h2></div>
            </div>
            <div class="d-flex text-black">          
            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>

                </thead>
                <tbody>
                    <?php
                        //fetch data from json  
                        $data = file_get_contents('member.json');
                        //decode into php array
                        $data = json_decode($data);
 
                        $index = 0;
                        $id = 1;
                        foreach($data as $row){
                           if( $row->Role=='User'){
                            echo  "
                                <tr>
                                   <td>" .$id."</td>
                                    <td>".$row->UserName."</td>
                                    <td>".$row->Email."</td>
                                    <td>".$row->Role."</td>
                                   
                                </tr>
                        "; $id++;}
                           $TotalUser=$id;
                            $index++;
                        }
                    ?>
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
      </div>   
    </div>
  </div>
 </div>
     


    
  </section>



<script>
 function confirmation(e){
    e.preventDefault();
    var url=e.currentTarget.getAttribute('href');
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
 })
.then((willCancel) => {
  if (willCancel) {
    window.location.href=url;
  } 
});

 }

 function confirmAdmin(e){
    e.preventDefault();
    var url=e.currentTarget.getAttribute('href');
    swal({
  title: "Are you sure?",
  text: "Make this Admin!",
  icon: "info",
  buttons: true,
  dangerMode: true,
 })
.then((willCancel) => {
  if (willCancel) {
    window.location.href=url;
  } 
});

 }


 let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

</script>

</body>
</html>