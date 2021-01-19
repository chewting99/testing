<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
$username= isset($_SESSION['currentUser'])?$_SESSION['currentUser']:"Anonymous";
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

        <title>Register</title>

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
                var passwordInput = document.getElementById('inputPassword');
                var passwordConfirmInput = document.getElementById('inputCPassword');
                var passStatus = document.getElementById('pass-status');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordConfirmInput.type = 'text';
                    passStatus.className = 'fa fa-eye-slash';
                } else {
                    passwordInput.type = 'password';
                    passwordConfirmInput.type = 'password';
                    passStatus.className = 'fa fa-eye';
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
                if (pass1.value == pass2.value) {
                    //The passwords match. 
                    //Set the color to the good color and inform
                    //the user that they have entered the correct password 
                    pass2.style.backgroundColor = goodColor;
                    message.style.color = goodColor;
                    message.innerHTML = "Passwords Match!"
                } else {
                    //The passwords do not match.
                    //Set the color to the bad color and
                    //notify the user.
                    pass2.style.backgroundColor = badColor;
                    message.style.color = badColor;
                    message.innerHTML = "Passwords Not Match!"
                }
            }
        </script>

        <!--Lock submit button-->
        <script type="text/javascript">
            $(function () {
                $("#inputUsername, #inputEmail", "#inputPassword", "#inputCPassword", "#inputName", "#inputPhone", "#inputGender", "#inputBday").bind("change keyup", function () {
                    if ($("#inputUsername").val() != "" && $("#inputEmail").val() != "" && $("#inputPassword").val() != "" && $("#inputCPassword").val() != "" && $("#inputName").val() != "" && $("#inputPhone").val() != "" && $("#inputBday").val() != "" && $("#inputGender").attr('checked') == true)
                        $(this).closest("form").find(":submit").removeAttr("disabled");
                    else
                        $(this).closest("form").find(":submit").attr("disabled", "disabled");
                });
            });
        </script>
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
                                    <?php
                                    if ($username == "Anonymous") {
                                        echo '<a class="dropdown-item" href="register.php">Register</a>'
                                         . '<a class="dropdown-item" href="order.php">Check Order Status</a>'
                                        . '<a class="dropdown-item" href="cartItem.php">My Cart</a>'
                                        . '<a class="dropdown-item" href="login.php">Member Login</a>'
                                        . '<a class="dropdown-item" href="managerLogin.php">Staff Login</a>';
                                    } else {
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
            <?php
            if (isset($_POST['registeracc'])) {
                $username = $_POST['inputUsername'];
                $email = $_POST['inputEmail'];
                $password = $_POST['inputPassword'];
                $name = $_POST['inputName'];
                $phone = $_POST['inputPhone'];
                $gender = $_POST['inputGender'];
                $bday = $_POST['inputBday'];

                $insert = "INSERT INTO register VALUES('{$username}','{$email}','{$password}','{$name}','{$phone}','{$gender}','{$bday}')";
                $checkUsername = mysqli_query($dbc, "SELECT * FROM register where username = '{$username}'");
                $checkEmail = mysqli_query($dbc, "SELECT * FROM register where email = '{$email}'");


                if (mysqli_num_rows($checkUsername) > 0) {
                    echo '<script>alert("Username is already been taken.")</script>';
                } else if (mysqli_num_rows($checkEmail) > 0) {
                    echo '<script>alert("Email is already been used.")</script>';
                } else if (mysqli_query($dbc, $insert)) {
                    echo '<center><h5><img src="Picture/download.png" width="20" height="20">';
                    echo '<script>alert("Successfully registered.")</script>';
                }
            }
            ?>  
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>Register</b></u></font></h1>

                </div>

            </section>
            <div class="album py-5 bg-light">
                <div class="container" align='center'>

                    <div style="padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <table align="center" width="600px">
                                <tr><td><label for="inputUsername">Username :</label></td><td><input type='text' name='inputUsername' id="inputUsername" maxlength="32" placeholder="abc123" autofocus required="required"/></td></tr>
                                <tr><td><label for="inputEmail">Email :</label></td><td><input type='email' name='inputEmail' id="inputEmail" required="required" placeholder="example123@gmail.com"/></td></tr>
                                <tr><td><label for="inputPassword">Password :</label></td><td><input type='password' name="inputPassword" id="inputPassword" minlength="8" maxlength="16" id='password' required placeholder="Min:8 Max:16"/><i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i></td></tr>
                                <tr><td><label for="inputCPassword">Confirm Password :</label></td><td><input type="password" name="inputCPassword" id="inputCPassword" minlength="8" maxlength="16" placeholder="Min:8 Max:16" onkeyup="checkPass(); return false;"/><span id="confirmMessage" class="confirmMessage"></span></td></tr>
                                <tr><td><label for="inputName">Name :</label></td><td><input type="text" name="inputName" id="inputName" required="required" ></td></tr>
                                <tr><td><label for="inputPhone">Cell phone :</label></td><td><input type="tel" name="inputPhone" id="inputPhone" placeholder="011-1234567" pattern="^[0][1]\d-\d{7}$" required="required"></td></tr>
                                <tr><td><label for="inputGender">Gender :</label></td><td><input type="radio" name="inputGender" id="inputGender" value="M" required="required">Male <input type="radio" name="inputGender" id="inputGender" value="F">Female</td></tr>
                                <tr><td><label for="inputBday">Birthday</label></td><td><input type="date" name="inputBday" id="inputBday"></td></tr>
                            </table>
                            <br><br>
                            <input type="submit" value="Register now" id="register" name="registeracc" >   <input type="reset" value="Reset" id="reset">
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
<?php
mysqli_close($dbc);
?>