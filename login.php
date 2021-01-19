<?php
$host = 'localhost';
$user = 'root';
$dbpass = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $dbpass, $database);
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
session_start();    

if(isset($_REQUEST['logout']))
{
    session_destroy ();
}
?>
    <title>Login</title>

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
            
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>Customer Login</b></u></font></h1>
            
        </div>
          
      </section>
        <div><h5><center><a href="login.php"><u><b>Customer</b></u></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="managerLogin.php"><u><b>Staff</b></u></a></center> </h5></div>
        <div class="album py-5 bg-light">
        <div class="container" align='center'>
            
            <div style="padding-left: 25px;padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <table width="500px">
                    <tr><td>Username:</td><td><input type='text' name='username'maxlength="32" autofocus required/></td></tr>
                
                <tr><td>Password:</td><td><input type='password' name='userpass' maxlength="16" id='password' required/></td></tr>
              
                </table>
          <br>
              <input type="submit" value="Log in" name="userlogin">
              <?php
              if(isset($_REQUEST['userlogin'])){
                  $login = $_POST['username'];
                  $password = $_POST['userpass'];
                  $sql = "Select username from register where username='{$login}' AND password='{$password}'";
                  $result= mysqli_query($dbc, $sql);
                  $row = mysqli_fetch_array($result);
                  
                  if(isset($row)){
                      extract($row);
                      $_SESSION['currentUser'] = $username;
                      echo "<script>window.location.href = 'handbag.php'</script>";
                  }
                  else{
                      echo "<br><div style='color:red'>Wrong username or password</div>";
                      }
                  }
              ?>
      </form>
   
         </div>
        </div>
      </div>
              
    </main>
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
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="assets/js/vendor/holder.min.js"></script>
  </body>
</html>
