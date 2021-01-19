<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
$count = 0;
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";

if(isset($_REQUEST['user'])){
    $username = $_REQUEST['user'];
    $delItem = $_REQUEST['del'];
    $sql = "DELETE FROM wishlist where username = '{$username}' AND product_id = '{$delItem}'";
    if(mysqli_query($dbc, $sql)){
        echo '<script>alert("Item has been successfully deleted from My wishlist.");</script>';
    }
    else if(!mysqli_query($dbc, $sql)){
        echo '<script>alert("Failed to remove from My wishlist");</script>';
    }
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

    <title>My Wishlist</title>

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
        <div class="container">
            
            <div style='padding-left:800px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $username ?> </b></h7>
            <?php
            if($username != "Anonymous")
            {
            echo "<a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
            }
            ?>
           
            </div><br/>
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>My Wishlist</b></u></font></h1>
            
        
        </div>
          
      </section>
       
        <br>
        <div style="margin-left:270px">You have <?php echo $count ?> item(s) in cart.</div>
            <div class="row">
                
           
 <table border="2" width="1000" align="center">
     
     <tr><th><b>Product ID</b></th><th><b>Product Name</b></th><th><b>Price(RM)</b></th><th><b>    </b></th><th><b>    </b></th></tr>
  
      <?php
         $sql = "SELECT * FROM wishlist WHERE username = '{$username}'";
         $wishlist = mysqli_query($dbc, $sql);
          while($row= mysqli_fetch_array($wishlist)){
              extract($row);         

          ?>
    
             <tr>
                 <td><?php echo $row['product_ID'] ?></td>
                 <td><?php echo $row['product_name'] ?></td>
                 <td><?php echo $row['product_price']?></td>
                 <td><a href='prod_review.php?id=<?php echo $row['product_ID']?>'><img src="Picture/addCart.png" width="20" height="20"></a></td>
                 <td><a href='wishlist.php?user=<?php echo $row['username']?>&del=<?php echo $row['product_ID']?>'><img src="Picture/delete.png" width="20" height="20"></a></td>
             </tr>

        <?php } ?>
        <?php
        function delete(){
            $sqlDel = "DELETE FROM wishlist WHERE product_ID = '{$row['product_ID']}' && username = '{$username}'";
            if(isset($_POST['delete'])){
                if(mysqli_query($dbc, $sqlDel)){
                    echo '<script>alert("The item has been removed from your wishlist.");</script>';
                }
            }
        }
        ?>       
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
  </body>
</html>
<?php 

mysqli_close($dbc);
?>
