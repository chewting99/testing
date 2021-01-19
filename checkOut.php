<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);

session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";

$tdydate = date("Y/m/d");

$sql = "Select * from cart WHERE username='{$username}'";

if(isset($_REQUEST['confirmation']))
   {    
    $get = mysqli_query($dbc, $sql);
    while($row=mysqli_fetch_array($get)){
    extract($row);
    $value = $product_price*$quantity;
    $sqlinsert = "Insert INTO orderlist(prod_id, order_date, item_name, order_quantity, total_amount, username, order_status) VALUES('{$product_id}','{$tdydate}','{$product_name}','{$quantity}','{$value}','{$username}','Processing')";
    mysqli_query($dbc, $sqlinsert);
    
    $sqldelete = "Delete from cart WHERE username='{$username}'";
    mysqli_query($dbc, $sqldelete);
    
   
    }
    
    
   }
   
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Check out</title>

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
        <div class="container">
            <center><h3><font color = "black"><b>Payment</b></font></h3></center>
            
        </div>
          
      </section>
        <div class="album py-5 bg-light">
        <div class="container">
            
            <div class="row">
      <form align="center">
                <table align="center" width="800">
                    <tr><td>Card number:</td><td><input type='text' name='cardnum'maxlength="19" placeholder="0000 0000 0000 0000" autofocus required/></td></td><td></td><td><input type='hidden'/></td></tr>
                <tr><td>Name on card:</td><td><input type='text' name='name' required/></td></td><td></td><td><input type='hidden'/></td></tr>
                <tr><td>Expiration Date:</td><td><input type='text' name='date' required/></td><td>CCV:</td><td><input type='text' name='ccv' maxlength="3" required/></td></tr>
                <tr><td><td></td></td></tr>
                <tr><td>Address:</td><td><input type='textfield' name='date' maxlength="100" size="45" required/></td></tr>
                <tr><td>       </td><td><input type='text' name='date' size="45"/></td></tr>
                </table>
          <br><br>
              <input type="submit" value="Pay Now" name="confirmation"> 
            
        <?php
          
          if(isset($_REQUEST['confirmation']))
         {
            echo '<center><h5><img src="Picture/download.png" width="20" height="20">';
            echo 'Payment successfully made . . .</h5></center>';
         }
       ?>
             
                
             
      </form>
          
         </div>
        </div>
      </div>
         
                
    </main>
                
  </body>

      
    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
      
      </div>
    </footer>
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
</html>
<?php 
mysqli_close($dbc); 
?>