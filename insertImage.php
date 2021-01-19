<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$conn = mysqli_connect($host, $user, $password, $database);
session_start();
$m_username = isset($_SESSION['managerusername'])?$_SESSION['managerusername']:'';

$sqlcheck= "Select*from handbag";
$checking= mysqli_query($conn, $sqlcheck);
while($rowcheck= mysqli_fetch_array($checking))
{
    extract($rowcheck);
}

?>

<html>
  <title>Add items</title>

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
                 <a href="delete_and_edit.php" class="navbar-brand d-flex align-items-center">
              <h4><strong>Product</strong></h4>
               
                </a>
               
                    </div>
            </div>

          </div>
        </div>
          
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="insertImage.php" class="navbar-brand d-flex align-items-center">
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
            <div style='padding-left:800px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $m_username ?></b></h7></b></h7>&nbsp;&nbsp;&nbsp;<b><br><a style="color:black" href='login.php?logout=true'><u>Logout</u></a></b></div><br/>
            
            <h1 class="jumbotron-heading" style="font-size: 50px"><font color="black"><u><b>Add New Product</b></u></font></h1>
            
        </div>
          
      </section>
        <br><br>
    <div class="container" align='center'>
        <a href="insertImage.php" class="btn btn-primary my-2" style="background-color:grey">Add Product</a>
           <a href="delete_and_edit.php" class="btn btn-primary my-2">Edit and Delete</a>
           <a href="edit_order_status.php" class="btn btn-primary my-2">Order Status</a>
            
    <div style="padding-left: 25px;padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
        <table>
        <tr><td>Product ID:</td><td><input type='text' name='id' required/></td></tr>
        <tr><td>Product Name:</td><td><input type='text' name='name' required/></td></tr>
        <tr><td>Image:</td><td><input type='file' name='image' required/></td></tr>
        <tr><td>Price:</td><td><input type='text' name='price' required/></td></tr>
        <tr><td>Quantity:</td><td><input type='text' name='qty' required/></td></tr>
        <tr><td>Product Type:</td>
        <td>
        <select name="type" type="select">
        <option value="H">HandBag</option>
        <option value="B">BackPack</option>
        <option value="T">travel Bag</option>
        </select>
         </td>
        </tr>
        </table>
        <br>
        <input type='submit' name='add' value='Add product'/>
    </form>
        <?php
        if(isset($_POST['add']))
            {
            
            $id = $_POST['id'];
            $name = $_POST['name'];
            $image = "Picture/Image/".$_POST['image'];
            $price = $_POST['price'];
            $quantity = $_POST['qty'];
            $item_type=$_POST['type'];
            $query = "INSERT INTO handbag VALUES('{$id}','{$name}','{$image}','{$price}','{$quantity}','{$item_type}')";
            
            
             if(mysqli_query($conn, $query))
             {
             echo '<center><h5><img src="Picture/download.png" width="20" height="20">';
             echo "item successfully added</center>";
             }
           else 
            {
                echo '<center><h5><img src="Picture/failed.png" width="20" height="20">';
                echo "Product ID repeated</center>";
            }
              
              
            }
            
          
        ?>
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
 
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="assets/js/vendor/holder.min.js"></script>
  </body>
</html>


<?php
  mysqli_close($conn);
?>

