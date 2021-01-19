<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
$count = 0;
$sql = "Select * from orderlist WHERE username='{$username}' ORDER by order_date";
$takecart = mysqli_query($dbc, $sql);

 while($row = mysqli_fetch_array($takecart))
 {
     extract($row);
     $count++; //count the total order
 }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Order Status</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
    
    <link href="nav.css" rel="stylesheet">
  </head>

  <body>

    <header>
<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <div class="brand-name"><a class="navbar-brand" href="home.php"><b>T.O.P</b></a></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">HOME</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRODUCTS</a>
              <div class="dropdown-menu" aria-labelledby="dropdown07">
                  <a class="dropdown-item" href="handbag.php">All</a>
                <a class="dropdown-item" href="handbag.php?type=H">Backpack</a>
                <a class="dropdown-item" href="handbag.php?type=B">Travel bag</a>
                <a class="dropdown-item" href="handbag.php?type=T">Handbag</a>
              </div>
            </li>
            
          </ul>
            <ul style="list-style-type:none">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ACCOUNT</a>
              <div class="dropdown-menu" aria-labelledby="dropdown07">
                <?php if($username=="Anonymous"){
                    echo '<a class="dropdown-item" href="register.php">Register</a>'
                             . '<a class="dropdown-item" href="order.php">Check Order Status</a>'
                            . '<a class="dropdown-item" href="cartItem.php">My Cart</a>'
                            . '<a class="dropdown-item" href="login.php">Member Login</a>'
                            . '<a class="dropdown-item" href="managerLogin.php">Staff Login</a>';
                            
                }
                else{
                    echo '<a class="dropdown-item" href="profile.php">My Profile</a>'
                            . '<a class="dropdown-item" href="order.php">Check Order Status</a>'
                            . '<a class="dropdown-item" href="cartItem.php">My Cart</a>'
                            . '<a class="dropdown-item" href="wishlist.php">My Wishlist</a>';
                }
                ?>
              </div>
            </li></ul>
        </div>
      </div>
    </nav>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div>
            
            <div style='padding-left:1200px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $username ?> </b></h7>
            <?php
            if($username != "Anonymous")
            {
            echo "<br><a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
            }
            else
              echo"<br><a href='login.php' style='color:white'><u>Please log in</u></a>";
            ?>
           
           
            </div><br/>
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>My Orders</b></u></font></h1>
            
            
        
        </div>
          
      </section>
        <div class="album py-5 bg-light">
        <div class="container">
            
            <div class="row">
                
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have ordered <?php echo $count ?> item(s).
 <table border="2" width="1000" align="center">
     
     <tr><th><b>Order Date</b></th><th><b>Product Name</b></th><th><b>Quantity</b></th><th><b>Total Price(RM)</b></th><th><b>Status</b></th><th><b>Rate</b></th></tr>
     
      <?php
         
          $takecart = mysqli_query($dbc, $sql);
          while($row= mysqli_fetch_array($takecart))
           {
             extract($row);
             $sqlrating="Select*from rating where username_rate = '$username' AND order_id = '$order_id'";
             $rate= mysqli_query($dbc, $sqlrating);
             $row2= mysqli_fetch_array($rate);
          ?>
    
             <tr>
                 <td><?php echo $order_date ?></td>
                 <td><?php echo $item_name ?></td>
                 <td><?php echo $order_quantity ?></td>
                 <td><?php echo $total_amount ?></td>
                 <td><?php echo $order_status ?></td>                            
                 <td><form>
                         <input style="background-color:rgba(128,128,128, 0.3);border-radius:5px" type="button" value="Rate me" name="rate" onclick="location='rate.php?id=<?php echo $prod_id ?>&order_id=<?php echo $order_id ?>'" 
                             <?php if($order_status!='Delivered' || isset($row2)){ ?> disabled style='color:grey' <?php } else{?>style='color:black' <?php } ?> /></form></td>
             </tr>
            
        
          
        <?php } ?>
   </table>  
         </div>
        </div>
      </div>
                   
    </main>
     
    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
      
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="assets/js/vendor/holder.min.js"></script>
    </body>
</html>
<?php 

mysqli_close($dbc);
?>
