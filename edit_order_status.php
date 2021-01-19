<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
$count = 0;

session_start();
$m_username = isset($_SESSION['managerusername'])?$_SESSION['managerusername']:'';
$sql = 'Select * from orderlist ORDER BY order_date';
$r = mysqli_query($dbc, $sql);
$updated=false;
if(isset($_POST['confirm_update'])){
         $status = $_POST['order_status'];
         $orderID = $_POST['order_id'];
         foreach($orderID as $key => $id){ 
           $sqlUpdate = "UPDATE orderlist SET order_status='{$status[$key]}' WHERE order_id='{$id}'";
           $query = mysqli_query($dbc,$sqlUpdate);
           if(isset($query)){
               $updated = true;
            }
         }
}
while($row= mysqli_fetch_array($r))
{
     $count ++;
     extract($row);
}

$sql = 'Select * from orderlist ORDER BY order_date, username';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Customer Orders</title>

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
            <center><h3><font color = "black"><b><u>Customer Orders</u></b></font></h3></center>
          
        </div>
          
      </section>

        <div class="album py-5 bg-light">
        <div class="container" align="center">
            <a href="insertImage.php" class="btn btn-primary my-2">Add Product</a>
           <a href="delete_and_edit.php" class="btn btn-primary my-2">Edit and Delete</a>
           <a href="edit_order_status.php" class="btn btn-primary my-2" style="background-color:grey">Order Status</a>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> 
                <br><b>Search:&nbsp;</b><input type="text" name="search" placeholder=" Product name"/><button style="background:white;border-color:white" type="submit" name="submit"><img style='width:20px;height:20px' src='Picture/search.png'/></button>
            </form>
            <div>
                 <div align="left" style="margin-left:50px">Total Order(s): <?php echo $count ?></div>
                 <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <table border="2" style="margin-left:50px" width="1000" align="center">
                    <input type="hidden" name="count" value="<?php echo $count ?>">
                    <tr style="text-align: center"><th><b>Order Date</b></th><th><b>Product Name</b></th><th><b>Quantity</b></th><th><b>Total price</b></th><th><b>Ordered by</b></th><th>Status</th></tr>
                    <?php 
                     
   
          $search = false;
            if(isset($_REQUEST['submit'])){
                $sql = "select * from orderlist WHERE item_name LIKE '%{$_REQUEST['search']}%'"; //(search engine) get the input from user then sort from database
            }
          $r = mysqli_query($dbc, $sql);
          while($row= mysqli_fetch_array($r)){
              extract($row);
              if(isset($row))
                  $search=true;
                    ?>
                    <input type="hidden" name="order_id[]" value="<?php echo $order_id ?>">
                    <tr>
                        <td align="center"><?php echo $order_date ?></td>
                        <td align="center"><?php echo $item_name ?></td>
                        <td align="center"><?php echo $order_quantity ?></td>
                        <td align="center"><?php echo $total_amount ?></td>
                        <td align="center"><?php echo $username ?></td>
                        <td style="width:10px">
                            <select type="select" name="order_status[]">
                                <option <?php if($order_status == "Processing") echo "selected='$order_status'"?> value="Processing">Processing</option>
                                <option <?php if($order_status == "Shipping") echo "selected='$order_status'"?> value="Shipping">Shipping</option>
                                <option <?php if($order_status == "Delivered") echo "selected='$order_status'"?> value="Delivered">Delivered</option>
                            </select>
                        </td>
                   </tr>      
            <?php } 
          if($search == false)
        {
              echo "No result found";
        }
        ?>
            </table>
                    
                  <br><br>
                 <input type="submit" value="Update" name="confirm_update">&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" name="cancellation" onclick="location='delete_and_edit.php'">
                 </form>
   
         </div>
        </div>
            
             
            <?php
            if($updated){
            echo '<center><h5><img src="Picture/download.png" width="20" height="20"><br>';
            echo 'Update successfully</center>';
            
            }
            
            ?>
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