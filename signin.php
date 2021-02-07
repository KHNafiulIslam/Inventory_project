<?php
  include "auth/connection.php";

  $conn = connect();
  $m="";
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $uName = $_POST['username'];
    $email = $_POST['email']?$_POST['email']:'';
    $password = $_POST['password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sq="INSERT INTO user_info (name,uname,email,password,address,contact) 
    VALUES('$name','$uName','$email','$password','$address','$contact')";
    if($conn->query($sq)===true){
      header('Location: login.php');
    }else{
      $m = 'Connection not Established';
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <title>InvenManage!</title>
  </head>
  <body>
  <nav class="navbar navbar-light bg-dark">
  <div class="container-fluid">
    <a style="color: white;" class="navbar-brand" href="index.php">
      <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-top">
      InvenManage
    </a>
  </div>
</nav>
<span style="color:skyblue">
<?php
if($m!=""){
echo $m;
}
?></span>
<h1 style="text-align: center;color:blue;">Registration Form</h1>
  <div class="container">
  <div class="container"> 
  <form class="row g-3" method="POST" action="signin.php" enctype="multipart/form-data">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" require>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Username</label>
    <input type="text" class="form-control" id="uname" name="username" require placeholder="@unique" require>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="@gmail.com">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" require>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Contact</label>
    <input type="number" class="form-control" id="contact" name="contact" placeholder="+880" require>
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="col-12">
    <input type="submit" class="btn btn-primary" value="Submit" name="submit">
  </div>
</form>
<p>Already have an account?<a style="padding: 5px;" href="login.php">Log In</a></p>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  </body>
</html>