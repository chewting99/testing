<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
$get= isset($_REQUEST['id'])?$_REQUEST['id']:'';

$sql = "Select * from handbag WHERE handbag_ID='{$get}'";
$row = mysqli_query($dbc, $sql);
while($r=mysqli_fetch_array($row))
{
    extract($r);
}
$minus = 0;
$count = 0;
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$counttotal=0;
$sqlcountingstar = "Select star from rating WHERE product_id = '{$get}'";
$rowstar = mysqli_query($dbc, $sqlcountingstar);
while($r_star=mysqli_fetch_array($rowstar))
{
    extract($r_star);
    $counttotal++;
    if($star=='20')
    {
        $count++;
    }
    else if($star=='40')
    {
        $count1++;
    }
    else if($star=='60')
    {
        $count2++;
    }
    else if($star=='80')
    {
        $count3++;
    }
    else if($star=='100')
    {
        $count4++;
    }
    

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

    <title><?php echo $handbag_name ?></title>

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
            
            <?php
            if($username != "Anonymous")
            {
             echo"<div style='padding-left:800px;margin-top:-140px'><h7><b>Hi,&nbsp;$username</b></h7><br>";
            echo "<a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
            }
            else
            {
                echo" <div style='padding-left:1200px;margin-top:-90px'><h7><b>Hi,&nbsp;$username</b></h7><br>";
                 echo"<a href='login.php' style='color:white'><u>Please log in</u></a>";
            }
            ?> 
            <?php
            
            if($username != "Anonymous")
            {
            echo "<a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
            }
            ?>
           
            </div><br/>
            
        
        
        </div>
          
      </section>
        <?php
        
   if(isset($_REQUEST['addtocart']))
    {
    $minus = $_REQUEST['addqty'];
    $quantity = $quantity-$minus;
    $sqlInsert = "INSERT INTO cart (product_id,product_name,product_price,quantity,username) VALUES ('{$handbag_ID}','{$handbag_name}','{$handbag_price}','{$minus}','{$username}')";
   $sqlupdateqty = "UPDATE handbag SET quantity = '{$quantity}' WHERE handbag_ID = '{$handbag_ID}'";
    if(mysqli_query($dbc,$sqlInsert))
    {
           if(mysqli_query($dbc, $sqlupdateqty))
           {
               echo '<center><h5><img src="Picture/download.png" width="20" height="20">';
              echo "Added to cart successfully</center>";
           }
    }
}
        ?>
        <?php 
            if(isset($_REQUEST['addtowishlist'])){
                $wishlist = "INSERT INTO wishlist VALUES('{$handbag_ID}','{$handbag_name}','{$handbag_price}','{$username}')";
                if(mysqli_query($dbc, $wishlist)){
                    echo '<script>alert("Successfully added into your wishlist.<a href="handbag.php">Return to product page.</a>")</script>';             
                }
            }
        
        ?>
        
              
        <div class="album py-5 bg-light">
        <div class="container">
            <form action="<?php echo "prod_review.php?id=$handbag_ID"?>" method="post">
             <table width="1000">  
                 <tr><td colspan="3"><img src="<?php echo $handbag_image ?>" width="200" height="200"></td><td>
                         <table width='200px'><tr><td align='right'>5 STAR&nbsp;</td><td width='100px'><span style='vertical-align:middle;height:10px;display: inline-block;background-color:yellow;width:<?php echo $count4/$counttotal*100 ?>px'></span></td><td><?php echo $count4?></td></tr>
                             <tr><td align='right'>4 STAR&nbsp;</td><td width='100px'><span style='vertical-align:middle;height:10px;display: inline-block;background-color:yellow;width:<?php echo $count3/$counttotal*100 ?>px'></span></td><td><?php echo $count3?></td></tr>
                             <tr><td align='right'>3 STAR&nbsp;</td><td width='100px'><span style='vertical-align:middle;height:10px;display: inline-block;background-color:yellow;width:<?php echo $count2/$counttotal*100 ?>px'></span></td><td><?php echo $count2?></td></tr>
                             <tr><td align='right'>2 STAR&nbsp;</td><td width='100px'><span style='vertical-align:middle;height:10px;display: inline-block;background-color:yellow;width:<?php echo $count1/$counttotal*100 ?>px'></span></td><td><?php echo $count1?></td></tr>
                             <tr><td align='right'>1 STAR&nbsp;</td><td width='100px'><span style='vertical-align:middle;height:10px;display: inline-block;background-color:yellow;width:<?php echo $count/$counttotal*100 ?>px'></span></td><td><?php echo $count?></td></tr>
                         </table></td></tr>
                 <tr><td width="150">Product Name</td><td width="15">:</td><td colspan="2"><?php echo $handbag_name?></td></tr>
                 <tr><td width="150">Unit Price</td><td width="15">:</td><td><?php echo $handbag_price ?></td><td align="right">Qty: <input type="number" style='color:black' class="btn btn-sm btn-outline-secondary" min="1" max="<?php echo $quantity ?>" name="addqty" value="1">
                 <button name="addtocart" value="<?php echo $handbag_ID ?>" class="btn btn-sm btn-outline-secondary" type='submit'  <?php if($quantity==0){ ?> disabled style='color:grey' <?php } else{ ?> style='color:black' <?php } ?>>Add to cart</button>
                 <button type="submit" name="addtowishlist" value="<?php echo $handbag_ID?>" class="btn btn-sm btn-outline-secondary" style="color:black">Add to wishlist</button></td>
                  
                        </tr>
            
             </table>
                <br><br>
            <table border="1px" width="1200" height="50px">
         
             <tr><td border="1px">&nbsp;Comments:</td><tr>
            </table>
            <table>
              
               <?php
               $sql2 = "Select comment,username_rate from rating WHERE product_id='{$get}'";
               $row2= mysqli_query($dbc, $sql2);
               while($r=mysqli_fetch_array($row2))
              {
                  extract($r);
                  echo "<tr><td><b>{$username_rate}</b></td></tr>";
                  echo "<tr><td></td></tr>";
                  echo "<tr><td>{$comment}</td></tr>";
              
              }?>
             
            </table>
            </form>
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
