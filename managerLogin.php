<?php
$host = 'localhost';
$user = 'root';
$dbpass = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $dbpass, $database);
session_start();    

if(isset($_REQUEST['logout']))
{
    session_destroy();
}
?>
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>

  <body>

    <header>
       
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
                 <a href="handbag.php" class="navbar-brand d-flex align-items-center">
              <h4><strong>Product</strong></h4>
               
                </a>
                <div align='right' style='margin-top:-50px; margin-right:-470px;font-size: 25px'><a href="login.php" style='color:white;font-weight: bold'>Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php" style='color:white;font-weight: bold'>Sign up</a>
                    </div>
            </div>
            <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white"><strong>Contact</strong></h4>
              <ul class="list-unstyled">
                <li><a href="www.twitter.com" class="text-white">Follow on Twitter</a></li>
                <li><a href="www.instagram.com" class="text-white">Like on Facebook</a></li>
                <li><a href="www.gmail/login/com" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
          
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="home.php" class="navbar-brand d-flex align-items-center">
                    <h4><strong>Home</strong></h4>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>


    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
            
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>Staff Login</b></u></font></h1>
            
        </div>
          
      </section>
        <div><h5><center><a href="login.php"><u><b>Customer</b></u></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="managerLogin.php"><u><b>Staff</b></u></a></center> </h5></div>
        <div class="album py-5 bg-light">
        <div class="container" align='center'>
            
            <div style="padding-left: 25px;padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <table width="500px">
                    <tr><td>Username:</td><td><input type='text' name='musername'maxlength="32" autofocus required/></td></tr>
                
                <tr><td>Password:</td><td><input type='password' name='mpass' maxlength="16" id='password' required/></td></tr>
              
                </table>
          <br>
              <input type="submit" value="Log in" name="mlogin">
              <?php
              if(isset($_REQUEST['mlogin']))
                  {
                  $m_login = $_POST['musername'];
                  $m_password = $_POST['mpass'];
                  $sql = "Select manager_username from manager where manager_username='{$m_login}' AND manager_pass='{$m_password}'";
                  $result= mysqli_query($dbc, $sql);
                  $row = mysqli_fetch_array($result);
                  
                  if(isset($row))
                  {
                      extract($row);
                      $_SESSION['managerusername'] = $manager_username;
                      echo "<script>window.location.href = 'insertImage.php'</script>";
                  }
                  else
                      {
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
