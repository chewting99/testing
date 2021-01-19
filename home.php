<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
$get = (isset($_REQUEST['type']))?$_REQUEST['type']:'';

$character = '123456789';
$cat='HB';
$imagePath = array();
$exist = false;
for($i=0;$i<8;$i++){
do{
    $exist=false;
    do{
$randomID = $character[rand(0,8)];
$category = $cat[rand(0,1)];
$rand_prodID = $category.'100'.$randomID;
$sqlimage = "Select handbag_ID, handbag_image from handbag where handbag_id = '$rand_prodID'";
$resultimage= mysqli_query($dbc, $sqlimage);
$rowimage=mysqli_fetch_array($resultimage);
}while(!isset($rowimage)); //check if the database have the image or not
foreach($imagePath as $row){
    if($row['handbagID'] == $rand_prodID)
        $exist=true;
}
}while($exist==true); //check if the array already consist of the product or not (prevent repeat)
$imagePath += array($i => ["handbagID" => $rowimage['handbag_ID'], "handbagImage" => $rowimage['handbag_image']]); //if the product id has no repeated, then it will be added to the array.
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

    <title>Home</title>

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
                <a class="nav-link" href="home.php">HOME <span class="sr-only">(current)</span></a>
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
       
        <section class="jumbotron text-center" style="background-color:grey">
            <div style='margin-top:-150px'><img src="Picture/logo.png" width="300px" height="200px"></div><br>
      
            
            <?php
            if($username != "Anonymous")
            {
             echo"<div style='padding-left:800px;margin-top:-140px'><h7><b>Hi,&nbsp;$username</b></h7><br>";
            echo "<a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
            }
            else
            {
                echo" <div style='padding-left:1200px;margin-top:-140px'><h7><b>Hi,&nbsp;$username</b></h7><br>";
                 echo"<a href='login.php' style='color:white'><u>Please log in</u></a>";
            }
            ?> 
            <br/> 
          </div>
         
            
      </section>
        <table align="center">
            <h3 style="color:red;background-color:yellow" align="center">New Promotion !!!</h3>
            <?php for($a=0,$b=0;$a<4;$a++){?>
            <tr><td><img src="<?php print_r($imagePath[$b]['handbagImage']);?>" onclick="location='prod_review.php?id=<?php print_r($imagePath[$b]['handbagID'])?>'" height="300" width="300"></td><?php $b++; ?>
                <td><img src="<?php print_r($imagePath[$b]['handbagImage']);?>" onclick="location='prod_review.php?id=<?php print_r($imagePath[$b]['handbagID'])?>'" height="300" width="300"></td><?php $b++; ?></tr>
            <?php } ?>
        </table>
        <footer class="text-muted" style="background-color:black">
            <h6 align="center">COPYRIGHTED COPY © 2018 FROM T.O.P FASHION ™<br>("T.O.P FASHION® MALAYSIA") AND "T.O.P IS THE BEST'S CORPORATION TRADEMARK AND ITS AFFILIATES.</h6>
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p></p>
        <p> <a href=""></a> <a href="getting-started/"></a></p>
      </div>
    </footer>

    
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