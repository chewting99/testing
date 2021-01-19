<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";

$sql = "SELECT * FROM register WHERE username = '{$username}'";
$result = mysqli_query($dbc, $sql);
$row = mysqli_fetch_array($result);
extract($row);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Change password</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
    
    <link href="nav.css" rel="stylesheet">
    
    <!--Password view icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    <!--Password strength-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    
    <!--Password visiblity-->
    <script type="text/javascript">
    function viewPassword()
    {
        var passwordInput = document.getElementById('currentPassword');
        var passwordNewInput = document.getElementById('newPassword')
        var passwordConfirmInput = document.getElementById('repeatPassword');
        var passStatus = document.getElementById('pass-status');
 
        if (passwordInput.type === 'password'){
            passwordInput.type = 'text';
            passwordNewInput.type = 'text';
            passwordConfirmInput.type = 'text';
            passStatus.className='fa fa-eye-slash';
        }
        else{
            passwordInput.type='password';
            passwordNewInput.type = 'password';
            passwordConfirmInput.type = 'password';
            passStatus.className='fa fa-eye';
        }
    }
    </script>
    
    <!--Password confirmation-->
    <script type="text/javascript">
    function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('newPassword');
    var pass2 = document.getElementById('repeatPassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Not Match!"
    }
}  
    </script>
  </head>

  <body>
      <?php 
      if(isset($_POST['submit'])){
        $password = $row['password'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $repeatPassword = $_POST['repeatPassword'];
                
            if($currentPassword == $password){
                if($newPassword == $repeatPassword){
                $sqlu = "UPDATE register SET password='{$newPassword}' WHERE username='{$username}'";        
                if(mysqli_query($dbc, $sqlu)){
                    echo '<alert("Your password has been successfully changed.<a href="myProfile.php">Return to My Profile</a>")</script>';
                }else{
                    echo '<script>alert("Failed to change your password.<a href="#">Retry</a>")</script>';
                }
                }else{
                    echo '<script>alert("New password and repeat password unmatch.")</script>';
                }
            }else{
                echo '<script>alert("Wrong password.")</script>';
            }
        
    }
      ?>
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
            <div style='padding-left:800px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $username; ?></b></h7></b></h7>&nbsp;&nbsp;&nbsp;<b><br><a style="color:black" href='login.php?logout=true'><u>Logout</u></a></b></div><br/>
            <center><h3><font color = "black"><b><u>My Profile</u></b></font></h3></center>
        
        </div>
          
      </section>

        <div class="album py-5 bg-light">
        <div  align="center">
            <div>
               <div style="padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
                <form style="padding-left:100px" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <table width="600px">    
                    <tr colspan="2"><h5>Change password</h5></tr>
                    <tr><th>Current Password : </th><td><input type="password" name="currentPassword" id="currentPassword" autofocus><i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i></td></tr>
                    <tr><th>New Password : </th><td><input type="password" name="newPassword" id="newPassword" minlength="8" maxlength="16" placeholder="Min = 6 | Max = 8"></td></tr>
                    <tr><td></td><td><meter max="4" id="password-strength"></meter><p id="password-strength-text"></p></td></tr>

                    <script type="text/javascript">
                        var strength = {
                        0: "Weakest",
                        1: "Weak",
                        2: "OK",
                        3: "Good",
                        4: "Strong"
                        };
             
                      var password = document.getElementById('newPassword');
                      var meter = document.getElementById('password-strength');
                      var text = document.getElementById('password-strength-text');
 
                       password.addEventListener('input', function() {
                       var val = password.value;
                       var result = zxcvbn(val);
                       
                    // This updates the password strength meter
                    meter.value = result.score;
 
                    // This updates the password meter text
                        if (val !== "") {
                        text.innerHTML = "Password Strength: " + strength[result.score]; 
                            } else {
                        text.innerHTML = "";
                            }
                        });
                        </script>
                        </td></tr>
                    <tr><th>Repeat Password : </th><td><input type="password" name="repeatPassword" id="repeatPassword" minlength="8" maxlength="16" placeholder="Min = 6 | Max = 8" onkeyup="checkPass(); return false;"><span id="confirmMessage" class="confirmMessage"></span></td></tr>
                    <tr><td colspan="2"><span id="confirmMessage" class="confirmMessage"></span></td></tr>
                    <tr><td></td><td><button type="submit" name="submit" value="submit">Confirm</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset">Reset</button></td></tr>
                </table>
         </div>
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
    
</html>
<?php 
mysqli_close($dbc); 
?>


