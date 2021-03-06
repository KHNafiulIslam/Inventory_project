<?php
    session_start();
    include ('navigation.php');
    include "auth/connection.php";
    $conn = connect();
    
    if(isset($_GET['id'])){
      $id= $_GET['id'];
 
      $sql= "SELECT * from product WHERE id='$id' limit 1";
      $res= mysqli_fetch_assoc($conn->query($sql));
    }

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM user_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

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
<div class="pt-20 pl-20">
                <div class="col-sm-12" style="background-color: #282828; ">
                    <div class="text-center">
                        <h2 > Product Details</h2>
                    </div>
                    <div class="row pt-20" >
                        <!-- <div class="col-sm-5 p-20" >
                            <img src="<?php echo $img; ?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                        </div> -->

                        <div class="col-sm-7" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"> Name:</h2>
                                </div>
                                <div class="col-sm-6">
                                    <h4 style="color: whitesmoke;"><?php echo ucwords($res['name']) ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2 style="color: whitesmoke;"> Buy Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 style="color: whitesmoke;"><?php echo $res['bought'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2 style="color: whitesmoke;"> Sell Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 style="color: whitesmoke;"><?php echo $res['sold'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2 style="color: whitesmoke;"> Created at:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 style="color: whitesmoke;"><?php echo date('F j, Y', strtotime(str_replace('-','/',$res['created']))) ?></h4>
                                </div>
                            </div>
                            <div class="text-center">
                                <a style="background-color: transparent;" href="editProduct.php?id=<?php echo $res['id']; ?>"><button class="btn btn-warning">Edit</button></a>
                                <a style="background-color: transparent;" href="deleteProduct.php?id=<?php echo $res['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include ('footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
