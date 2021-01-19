<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
$get = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$orderID = isset($_REQUEST['order_id'])?$_REQUEST['order_id']:'';
 if(isset($_POST['confirmation']))
 {
     $order_id = $_POST['getID'];
     $prod_id = $_POST['prodID'];
     $rating = $_POST['rating'];
     $comment = $_POST['comment'];
     $sqlValidate = "Select * from rating where order_id = '$order_id' AND username_rate = '$username'";
     $resultValidate = mysqli_query($dbc, $sqlValidate);
     $rowValidate = mysqli_fetch_array($resultValidate); 
     if(!isset($rowValidate)){
         $sqlinsert = "Insert into rating(order_id, product_id, username_rate, star, comment) VALUES('{$order_id}', '{$prod_id}', '{$username}', '{$rating}', '{$comment}')";
         mysqli_query($dbc, $sqlinsert);
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

    <title>Order</title>

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
            <h2 class="jumbotron-heading"><font color="black"><u><b>Rate This Product</b></u></font></h2>
            

        </div>
          
      </section>
        <?php 
        if($get!=''){
        $sql = "Select * from orderlist WHERE username='{$username}'AND prod_id='{$get}' AND order_id = '{$orderID}'";
$takecart = mysqli_query($dbc, $sql);
 while($row = mysqli_fetch_array($takecart))
 {
     extract($row);
 }

 ?>
        <div class="album py-5 bg-light">
        <div class="container">
            
            <div style="margin-left:-120px" align='center'>
        <form style="padding-left:100px" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" align='center'>
            
            <input type="hidden" id="rate" name="rating"/>
            <input type="hidden" name="getID" value="<?php echo $order_id ?>"/>
            <input type='hidden' name='prodID' value='<?php echo $get ?>' />
             <table align='center'width='500'>                             <!-- pass in value '1' when the user click the first star--->
                 <tr align='center'><td colspan="2"><img src='Picture/white_star.png' width='40' height='40' id="star1" onclick="star(1)"><img src='Picture/white_star.png' width='40' height='40' id="star2" onclick="star(2)"><img src='Picture/white_star.png' width='40' height='40' id="star3" onclick="star(3)"><img src='Picture/white_star.png' width='40' height='40' id="star4" onclick="star(4)"><img src='Picture/white_star.png' width='40' height='40' id="star5" onclick="star(5)"></td></tr>
                 <tr><td><br></td></tr>
                 <tr><td align='right' style='vertical-align: top'>Comment:</td>
                     <td>
                         <textarea rows="4" cols="50" name='comment' ></textarea>
                     </td>
                </tr>
             </table>
            <br>
           <input style="margin-left:-20px" type="submit" value="Confrim" name="confirmation">&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" name="cancellation" onclick="location='order.php'">
           </form>
                <?php
        }
                if($get=='')
                {
                echo '<center><h5><img src="Picture/download.png" width="20" height="20">';
                echo 'Thanks for your feedback<br><br>';
                echo "<a href='order.php'>Back To List</a>";
                }
               ?>
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
    <script language="javascript">
        
   function star(position)
   {
       for(var i=1; i<=position; i++)
       {               //star+i is represent the arrangement of star
           document.getElementById("star"+i).src="Picture/yellow_star.jpg"; //if the looping condition is correct, change the image from white_star to yellow_star.
       }
      
       for(var a=i;a<=5;a++)
         {
             document.getElementById("star"+a).src="Picture/white_star.png";
         }
         i = 1, a = 0;
         document.getElementById("rate").value=position*20;
   }
   </script>
  </body>
</html>
<?php 

mysqli_close($dbc);
?>
