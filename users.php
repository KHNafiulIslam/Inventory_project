<?php
    session_start();
    include ('navigation.php');
    include "auth/connection.php";
    $conn = connect();
    $m="";
    
    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM user_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    if(isset($_POST['submit'])){
        if($thisUser['password']==$_POST['pass']){
            $sq= "UPDATE user_info SET ";
            if(isset($_POST['uname'])){
                $uName= $_POST['uname'];
                if($uName!= $thisUser['name']){
                    $sq .= "name = '$uName',";
                }
            }
            if(isset($_POST['email'])){
                $uEmail= $_POST['email'];
                if($uName!= $thisUser['email']){
                    $sq .= "email = '$uEmail',";
                }
            }
            if(isset($_POST['npass'])&& $_POST['npass']!=''&& isset($_POST['cpass'])&& $_POST['cpass']!=''){
                if($_POST['npass']==$_POST['cpass']){
                    $pass= $_POST['npass'];
                    if($pass!=$thisUser['password']){
                        $sq .="password= '$pass',";
                    }
                }
            }
            $sq= substr($sq, 0,-1);
            $sq .=" WHERE id='$id'";
            $conn->query($sq);
            $m= 'Users Information Successfully Updated!';
        } else{
            $m= "Credentials mismatch!";
        }
    }
    $sql= "SELECT * from user_info";
    $res= $conn->query($sql);

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
<div class="card">
                <div class="text-center">
                <button style="margin: 5px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Edit Your Profile
                </button>
                    <h1 style="color: green;"><?php echo $m;?></h1>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel"><?php echo $thisUser['name']; ?></h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="users.php" enctype="multipart/form-data">
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="uname" class="pr-10"> User Name</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="uname" type="text" class="login-input" placeholder="User Name" id="uname" value="<?php echo $thisUser['name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="email" class="pr-10"> Email </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="email" type="text" class="login-input" placeholder="Email Address" value="<?php echo $thisUser['email']; ?>" id="buy" required>
                                            </div>
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="pass" class="pr-10"> Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="pass" class="login-input" type="password" id="pass" required>
                                            </div>
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="npass" class="pr-10">New Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="npass" class="login-input" type="text" id="npass" >
                                            </div>
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="cpass" class="pr-10">Confirm New Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="cpass" class="login-input" type="text" id="cpass" >
                                            </div>
                                        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" value="submit" name="submit" class="btn btn-primary">Change</button>
      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<div class="pt-20 pl-20">
 <div class="table_container">
                    <h1 style="text-align: center;">Users Table</h1>
                    <div class="container">
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead class="thead-light">
                            <tr>
                                <th data-field="date" data-filter-control="select" data-sortable="true">User</th>
                                <th data-field="examen" data-filter-control="select" data-sortable="true"> Email</th>
                                <!-- <?php
                                    if($thisUser['is_admin']==1){
                                        echo '<th data-field="note" data-sortable="true">Is Active</th>';
                                    }
                                ?> -->
                                <th data-field="note" data-sortable="true">Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysqli_num_rows($res)>0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo '<tr>';
                                    echo '<td>'. $row['name'].'</td>';
                                    echo '<td>'. $row['email'].'</td>';
                                    echo '<td>'. $row['contact'].'</td>';
                                    // if($thisUser['is_admin']==1) {
                                    //     if($row['is_active']=='1'){
                                    //         $active= "Active";
                                    //     } else{
                                    //         $active= "Inactive";
                                    //     }
                                    //     echo '<td>' . $active . '</td>';
                                    // }
                                    // echo '<td>'. date("Y-m-d h:i:sa",strtotime($row['last_login_time'])).'</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>
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
