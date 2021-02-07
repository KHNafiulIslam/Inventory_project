<?php
    session_start();
    include ('navigation.php');
    include "auth/connection.php";
    $conn = connect();
    
    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM user_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    $date = date('y-m-d',strtotime('-7 days'));
    $sql= "SELECT * FROM product WHERE updated>'$date'";
    $prod=$conn->query($sql);

    $sql= "SELECT COUNT(*) as products FROM product";
    $total_products= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_bought FROM product";
    $total_bought= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sold FROM product";
    $total_sold= mysqli_fetch_assoc($conn->query($sql));

    $stock_available= $total_bought['total_bought']-$total_sold['total_sold'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>InvenManage!</title>
  </head>
  <body>
  <div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card text-white bg-dark mb-3">
    <img src="<?php echo $thisUser['avatar']; ?>" class="img-circle" alt="Please Select your avatar">
      <div class="card-body">
        <p><h4><?php echo $thisUser['name'];  ?></h4> 
        Email: <?php echo $thisUser['email']; ?><br>
        Account Created: <?php echo date('F j, Y', strtotime($thisUser['created'])); ?></p>
        </div>
    </div>
  </div>
  <div class="col">
    <div class="card text-white bg-dark mb-3">
      <div class="card-body">
        <h5 class="card-title">Owners Info</h5>
        <p class="card-text">Some text.</p>
      </div>
    </div>
  </div>
</div>
  <div class="row row-cols-1 row-cols-md-4 g-4">
  <div class="col">
    <div class="card h-100">
      <div style="background-color: lightgreen;font-size:large;" class="card-body">
        <h5 class="card-title">Total Products</h5>
        <p class="card-text"><?php echo $total_products['products'] ?></p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div style="background-color: indianred;font-size:large;" class="card-body">
        <h5 class="card-title">Products Brought</h5>
        <p class="card-text"><?php echo $total_bought['total_bought'] ?></p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div style="background-color: lightblue;font-size:large;" class="card-body">
        <h5 class="card-title">Products Sold</h5>
        <p class="card-text"><?php echo $total_sold['total_sold'] ?></p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div style="background-color: lightcoral;font-size:large;" class="card-body">
        <h5 class="card-title">Available Stocks</h5>
        <p class="card-text"><?php echo $stock_available ?></p>
      </div>
    </div>
  </div>
</div>
<div class="container">
<table class="table table-dark table-hover">
<h1 style="text-align: center;">Products Table</h1>
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Bought</th>
      <th scope="col">Sold</th>
      <th scope="col">Available in Stock</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if(mysqli_num_rows($prod)>0){
        while($row= mysqli_fetch_assoc($prod)){
          $stock=$row['bought']-$row['sold'];
          echo "<tr>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['bought']."</td>";
          echo "<td>".$row['sold']."</td>";
          echo "<td>".$stock."</td>";
          echo "</tr>";
      }
  }
  ?>
  </tbody>
</table>
</div>
<?php
    include ('footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
