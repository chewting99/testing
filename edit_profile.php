<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username = isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : "Anonymous";

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

        <title>Change profile</title>

        <!-- Bootstrap core CSS -->
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="album.css" rel="stylesheet">

        <link href="nav.css" rel="stylesheet">

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
                    message.innerHTML = "Passwords Do Not Match!"
                }
            }
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
            if (isset($_POST['submit'])) {
                $name = $_POST['uName'];
                $gender = $_POST['uGender'];
                $phone = $_POST['uPhone'];
                $bday = $_POST['uBirthday'];
                $sqlu = "UPDATE register SET name='{$name}',gender='{$gender}',phone='{$phone}',birthday=CAST('{$bday}' AS DATE) WHERE username='{$username}'"; //Try now
                if (mysqli_query($dbc, $sqlu)) {
                    echo '<script>alert("Your personal information has been successfully updated.")</script>';
                } else {
                    die("Failed to update your personal information.<a href='edit_profile.php'>Retry</a>");
                }
            }
            ?>
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
                            <form style="padding-left:100px" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <table width="800px">    
                                    <tr colspan="2"><h5>Change personal informations</h5></tr>
                                    <tr><th>Email : </th><td><input type="email" id="uEmail" name="uEmail" value="<?php echo $email ?>"></td></tr>
                                    <tr><th>Name : </th><td><input type="text" id="uName" name="uName" value="<?php echo $name ?>"></td></tr>
                                    <tr><th>Gender : </th><td><input type="radio" name="uGender" id="uGender" value="M" <?php if ($gender == 'M') echo 'checked' ?>>Male<input type="radio" name="uGender" id="uGender" value="F" <?php if ($gender == 'F') echo 'checked' ?>>Female</td></tr>
                                    <tr><th>Cell phone : </th><td><input type="tel" id="uPhone" name="uPhone" value="<?php echo $phone ?>"></td></tr>
                                    <tr><th>Birthday : </th><td><input type="date" id="uBirthday" name="uBirthday" value="<?php echo $bday ?>"</td></tr>
                                </table>
                                <button type="submit" name="submit" value="submit">Confirm</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset">Reset</button>
                            </form>
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