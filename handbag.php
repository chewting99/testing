<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$username = isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : "Anonymous";
$get = (isset($_REQUEST['type'])) ? $_REQUEST['type'] : '';
$sqlselect = "SELECT * FROM handbag WHERE item_type LIKE'%{$get}%'"; //(filter)
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

        <title>Products</title>

        <!-- Bootstrap core CSS -->
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="album.css" rel="stylesheet">

        <link href="nav.css" rel="stylesheet">
        <script>

            jQuery(function ($) {
                $('select').on('change', function () {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
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

            <section class="jumbotron text-center">
                <div>
                    <div style='padding-left:1200px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $username ?></b></h7><br>
<?php
if ($username != "Anonymous") {
    echo "<a href='login.php?logout=true' style='color:black'><b><u>Logout</u></b></a>";
} else
    echo"<a href='login.php' style='color:white'><u>Please log in</u></a>";
?>


                    </div><br/>
                    <h1 class="jumbotron-heading"><font color="red"><?php if ($get == 'H') echo "Handbags";
                        else if ($get == 'B') echo "Backpacks";
                        else if ($get == 'T') echo "Travel bags";
                        else echo "All"; ?></font></h1>
                    <p class="lead text-muted"><font color="black">Come and grabs your favourite fashion bags here !!! Explore it out.</font></p>

                    <p>
                        <a href="handbag.php" <?php if ($get == '') echo "style='background:grey'";
                        else echo "style='background:blue'" ?> class="btn btn-primary my-2">All</a>
                        <a href="handbag.php?type=H" <?php if ($get == 'H') echo "style='background:grey'";
                        else echo "style='background:blue'" ?> class="btn btn-primary my-2">Handbag</a>
                        <a href="handbag.php?type=B" <?php if ($get == 'B') echo "style='background:grey'";
                        else echo "style='background:blue'" ?> class="btn btn-secondary my-2">Backpack</a>
                        <a href="handbag.php?type=T" <?php if ($get == 'T') echo "style='background:grey'";
                        else echo "style='background:blue'" ?> class="btn btn-primary my-2">Travel Bag</a>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> 
                        <center><b>Search:&nbsp;</b><input type="text" name="search"/><button style="background:white;border-color:white" type="submit" name="submit"><img style='width:20px;height:20px' src='Picture/search.png'/></button></center> 
                    </form>
                    </p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <?php
                        $search = false;
                        if (isset($_REQUEST['submit'])) {
                            $sqlselect = "select * from handbag WHERE handbag_name LIKE '%{$_REQUEST['search']}%'"; //(search engine) get the input from user then sort from database
                        }
                        $r = mysqli_query($dbc, $sqlselect);
                        while ($row = mysqli_fetch_array($r)) {
                            extract($row);
                            if (isset($row))
                                $search = true;
                            ?>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img src="<?php echo $handbag_image ?>" alt="<?php echo $handbag_ID ?>" class="card-img-top"  height="300" width="300">
                                    <center><b><?php echo $handbag_name ?></b></center>
    <?php echo "&nbsp&nbsp&nbsp&nbsp" ?>Available: <?php echo "$quantity<br>" ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">


                                            <div class="btn-group">                                                                                                                  

                                                <button class="btn btn-sm btn-outline-secondary" onclick="window.location.href = 'prod_review.php?id=<?php echo $handbag_ID ?>'">View</button>

                                            </div>

                                            <small class="text-muted"><font color="black" size="5px"><h5>RM<?php echo $handbag_price ?></h5></font></small> 
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        if ($search == false) {
                            echo "No result found";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <input type="hidden" id="hidden" value="<?php echo $get ?>" />
        </main>

        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Back to top</a>
                </p>
                <p></p>
                <p> <a href=""></a> <a href="getting-started/"></a></p>
            </div>
        </footer>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="assets/js/vendor/holder.min.js"></script>
<script language="javascript">
    <?php
    mysqli_close($dbc);
    ?>