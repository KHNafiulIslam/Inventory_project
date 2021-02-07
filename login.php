<?php
  session_start();
  $_SESSION['user']='';
  $_SESSION['userid']='';
    $m='';
    include "auth/connection.php";
    $conn = connect();
    if(isset($_POST['submit'])){
        $uName = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user_info WHERE uname = '$uName' AND password = '$password'";
        $log = $conn->query($sql);

        if(mysqli_num_rows($log)===1){
          $user=mysqli_fetch_assoc($log);
          $_SESSION['user']=$user['name'];
          $_SESSION['userid']=$user['id'];
            header('Location: dashboard.php');
        }else{
            $m='UserName or Password Mismatched!';
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
<span style="color:red;">
<?php
if($m!=""){
echo $m;
}
?>
<div class="container">
<h1 style="text-align: center;color:blue">Log In</h1>
  <form class="px-4 py-3" method="POST">
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">User Name</label>
      <input name="username" type="text" class="form-control" id="exampleDropdownFormEmail1" placeholder="@username" require>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
      <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" require>
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Log In" name="submit">
  </form>
  <div class="dropdown-divider"></div>
  <a style="color: white;" class="dropdown-item" href="signin.php">New around here? Sign up</a>
  <a style="color: white;" class="dropdown-item" href="#">Forgot password?</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>