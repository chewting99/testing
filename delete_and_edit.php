<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
$count = 0;
session_start();
$m_username = isset($_SESSION['managerusername'])?$_SESSION['managerusername']:'';
$get = (isset($_REQUEST['type']))?$_REQUEST['type']:'';
if($get=='')
{
    $sql = "Select * from handbag";
}
else
{
    $sql = "Select * from handbag WHERE item_type LIKE '%{$get}'";
}
$r = mysqli_query($dbc, $sql);

while($row= mysqli_fetch_array($r))
{
     $count ++;
     extract($row);
     
}


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Edit and Delete</title>

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
          <h4><strong>Products</strong></h4>
               </a>  
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
            <center><h3><font color = "black"><b><u> Delete and Edit</u></b></font></h3></center>
            <br>
            <a href="insertImage.php" class="btn btn-primary my-2">Add Product</a>
           <a href="delete_and_edit.php" class="btn btn-primary my-2" style="background-color:grey">Edit and Delete</a>
           <a href="edit_order_status.php" class="btn btn-primary my-2">Order Status</a>
        </div>
          
      </section>
        <div class="album py-5 bg-light">
        <div class="container" align="center">
            <a href="delete_and_edit.php" class="btn btn-primary my-2" <?php if($get == '') echo "style='background:grey'"; else echo "style='background:blue'" ?>>All</a>
           <a href="delete_and_edit.php?type=H" class="btn btn-primary my-2" <?php if($get == 'H') echo "style='background:grey'"; else echo "style='background:blue'" ?>>HandBag</a>
           <a href="delete_and_edit.php?type=B" class="btn btn-primary my-2" <?php if($get == 'B') echo "style='background:grey'"; else echo "style='background:blue'" ?>>BackPack</a>
           <a href="delete_and_edit.php?type=T" class="btn btn-primary my-2" <?php if($get == 'T') echo "style='background:grey'"; else echo "style='background:blue'" ?>>Travel Bag</a>
            <div class="row">
                 <div style="margin-left:70px">Total Item(s): <?php echo $count ?></div>
                <table border="2" width="1000" align="center">
               
                    <tr style="text-align: center"><th><b>Product photo</b></th><th><b>Product Name</b></th><th><b>Product Price</b></th><th><b>Quantity</b></th><th><b>Item type</b></th><th></th></tr>

                    <?php 
                    $r = mysqli_query($dbc, $sql);
                    while($row= mysqli_fetch_array($r))
                    {
                   
                        extract($row);
                    ?>
                    
                    <tr>
                        <td align="center"><img src="<?php echo $handbag_image ?>" width="100" height="100"></td>
                        <td align="center"><?php echo $handbag_name ?></td>
                        <td align="center">RM<?php echo $handbag_price ?></td>
                        <td align="center"<?php if($quantity==0) echo "style='color:red;font-weight:bold'"?>><?php echo $quantity ?></td>
                        <td align="center"><?php echo $item_type?></td>
                        <td align="center"><a href="edit.php?pid=<?php echo $handbag_ID ?>"><b style="color:black"><u>Edit</u></b></a>&nbsp;&nbsp;&nbsp;<a href="delete.php?pid=<?php echo $handbag_ID;?>"><b style="color:black"><u>Delete</u></b></a></td>
          
                   </tr>
      
         
                   <?php } ?>
        
               
         </div>
        </div>
      </div>
            </table>
                
      
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