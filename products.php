<?php
    session_start();
    include ('navigation.php');
    include "auth/connection.php";
    $conn = connect();
    $m='';
    if(isset($_POST['submit'])){
      $pName= $_POST['pname'];
      $buy= $_POST['buy'];
      // $img= $_FILES['pimage'];
      // $iName= $img['name'];
      // $tempName= $img['tmp_name'];
      // $format= explode('.', $iName);
      // $actualName= strtolower($format[0]);
      // $actualFormat= strtolower($format[1]);
      // $allowedFormats= ['jpg', 'png', 'jpeg', 'gif'];

      // if(in_array($actualFormat, $allowedFormats)){
      //     $location= 'Uploads/'.$actualName.'.'.$actualFormat;
          $sql= "INSERT INTO product(name, bought, created) VALUES ('$pName', '$buy', current_timestamp())";
          if($conn->query($sql)===true){
              // move_uploaded_file($tempName, $location);
              $m= "Product Inserted!";
          }
      // }

  }

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM user_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    $sql= "SELECT * FROM product";
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
<!-- Button trigger modal -->
<div class="text-center">
<button style="margin: 5px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add New Product
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="products.php" enctype="multipart/form-data">
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="name" class="pr-10"> Product Name</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pname" type="text" class="login-input" placeholder="Product Name" id="name" required>
                                                </div>
                                            </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="buy" class="pr-10"> Buying Amount</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="buy" type="text" class="login-input" placeholder="Buying Amount" id="buy" required>
                                                </div>
                                            <!-- </div>
                                            <div class="form-group pt-20">
                                                <div class="col-sm-4">
                                                    <label for="pimage" class="pr-10"> Product Image</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="pimage" class="pl-20" type="file" id="pimage" required>
                                                </div> -->
                                            </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" value="submit" name="submit" class="btn btn-primary">Add</button>
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
      <th scope="col">Actions</th>
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
          echo "<td><a href='viewProduct.php?id=".$row['id']."' class='btn btn-success btn-sm'>".
                "View</a>";
          echo "<a href='editProduct.php?id=".$row['id']."' class='btn btn-warning btn-sm'>".
                "Edit</span> </a>";
          echo "<a href='deleteProduct.php?id=".$row['id']."' class='btn btn-danger btn-sm'>".
                "Delete </a></td>";
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
