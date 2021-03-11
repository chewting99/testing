<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
$count = 0;
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
$sql = "Select * from cart WHERE username='{$username}'"; 
 if(isset($_REQUEST['p']))
     $cart_id = $_REQUEST['p'];
     $sqldlt = "Delete FROM cart where cart_id = '$cart_id'";
     $sqlGetID = "Select quantity,product_id from cart where cart_id ='$cart_id'";
     $resultID = mysqli_query($dbc, $sqlGetID);
     $Pid = mysqli_fetch_array($resultID);
     extract($Pid);
     $sql2 = "Select * from handbag WHERE handbag_ID = '$product_id'";
     mysqli_query($dbc, $sqldlt);
     $result=mysqli_query($dbc, $sql2);
     $r=mysqli_fetch_array($result);
     $qty = $r["quantity"];
     $qty+=$quantity;
  
     mysqli_query($dbc, $sqlupdate);
     echo "<script>window.location.href = 'cartItem.php'</script>";
     
 
 $takecart = mysqli_query($dbc, $sql);
 $totalprice = 0;
 
 while($row = mysqli_fetch_array($takecart))
 {
     extract($row);
     $totalprice += ($product_price*$quantity);
     $count++;
 }
 

?>
<!doctype html>
<html lang="en">
    <input type="hidden" name="hiddenfield" value="1"/>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>My Cart</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
    
        <link href="nav.css" rel="stylesheet">
  </head>



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
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>My Cart</b></u></font></h1>
            
        
        </div>
          
      </section>
       
        <br>
        <div style="margin-left:270px">You have <?php echo $count ?> item(s) in cart.</div>
            <div class="row">
                
           
 <table border="2" width="1000" align="center">
     
     <tr><th><b>Product ID</b></th><th><b>Product Name</b></th><th><b>Quantity</b></th><th><b>Total Price(RM)</b></th><th><b>    </b></th></tr>
  
      <?php
         
          $takecart = mysqli_query($dbc, $sql);
          while($row= mysqli_fetch_array($takecart))
           {
              extract($row);
          
          ?>
    
             <tr>
                 <td><?php echo $product_id ?></td>
                 <td><?php echo $product_name ?></td>
                 <td><?php echo $quantity ?></td>
                 <td><?php echo $product_price*$quantity ?></td>
                 <td><a href='cartItem.php?p=<?php echo $cart_id ?>'><img src="Picture/delete.png" width="20" height="20"></a></td>
             </tr>
            
        
          
        <?php } ?>
                <td></td>
                 <td></td>
                 <td><h5><b><font color ="black">TOTAL:&nbsp;</font></b></h5></td>
                 <td><?php echo $totalprice ?></td><td></td>
                 
                 <tr>
                     
                 </tr>
                     
                
         </div>
        </div>
      </div>
            </table>
                
                
    </main>
  <br>
      <form align="center">
       
        
      <input type="button" value="Proceed to check out" name="checkOut" onclick="location='checkOut.php'"<?php if($count==0){ ?> disabled style='color:grey' <?php } else{ ?> style='color:black' <?php } ?>>
       
      </form>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
      <p></p>
        <p> <a href=""></a> <a href="getting-started/"></a></p>
      </div>
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
    <script>$(function(){
        $('button[id="addtocart"]').click(function (event){
            var productID = event.target.value;
            var qty = $("#addqty"+productID).val();
            var type = $("#hidden").val();
            window.open('handbag.php?handbagid='+productID+'&addqty='+qty+'&type='+type, "_self");
        });
    })</script>
  </body>
</html>
<?php 

mysqli_close($dbc);
?>
