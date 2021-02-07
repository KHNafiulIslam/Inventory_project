<?php
    $user= $_SESSION['user'];
    $userid= $_SESSION['userid'];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/nav.css" rel="stylesheet">
    <title>InvenManage!</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link" href="dashboard.php">My Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Customers</a>
        </li>
      </ul>
      <span class="navbar-text">
        Logged In As <b class="users"><?php echo $user;?></b>
      </span>
      <a style="background-color: transparent;" href="logout.php"><button style="margin:5px;" type="button" class="btn btn-danger">Log Out</button></a>
    </div>
  </div>
</nav>
</body>
</html>