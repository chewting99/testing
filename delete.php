<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'product';
$dbc = mysqli_connect($host, $user, $password, $database);
session_start();
$m_username = isset($_SESSION['managerusername'])?$_SESSION['managerusername']:'';
$id = (isset($_REQUEST['pid']))?$_REQUEST['pid']:'';

$sql = "Select * from handbag WHERE handbag_ID = '{$id}'";
$result = mysqli_query($dbc, $sql);
 while ($row = mysqli_fetch_array($result)) 
    {
      
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

    <title>Delete product</title>

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



      <section class="jumbotron text-center">
        <div class="container">
            <div style='padding-left:800px;margin-top:-80px'><h7><b>Hi,&nbsp;<?php echo $m_username ?></b></h7></b></h7>&nbsp;&nbsp;&nbsp;<b><br><a style="color:black" href='login.php?logout=true'><u>Logout</u></a></b></div><br/>
            <center><h3><font color = "black"><b><u>Delete Product</u></b></font></h3></center>
        
        </div>
          
      </section>

        <div class="album py-5 bg-light">
        <div align="center">
    
       <div style="padding-top: 25px;padding-bottom:25px;border-style: solid;width: 600px;border-width: 2px;">
        <form style="padding-left:50px" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <table width="300px">
                    <tr align='center'><td colspan="2"><img src="<?php echo $handbag_image ?>" width="150" height="150"></td></tr>
                      <tr height="50px"><td></td></tr>
                <tr><td align><b>Product ID:</b></td><td><?php echo $handbag_ID ?></td></tr>
                <tr><td><b>Product Name:</b></td><td><?php echo $handbag_name ?></td></tr>
                <tr><td><b>Product Price:</b></td><td><?php echo $handbag_price ?></td></tr>
                <tr><td><b>Quantity:</b></td><td><?php echo $quantity ?></td></tr>
                <tr><td><b>Item type:</b></td><td><?php echo $item_type ?></td></tr>
                <tr height="50px"><td></td></tr>
            </table>
           
          <input style="margin-left:-100px" type="submit" value="Delete" name="confirmation">&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" name="cancellation" onclick="location='delete_and_edit.php'">
          <input type="hidden" value="<?php echo $id ?>" name="hiddenfield">
        </form>
         </div>

        </div>   
        <?php
        if(isset($_REQUEST['confirmation']))
        {
            $gethidden = $_POST['hiddenfield'];
            $sql = "Delete from handbag WHERE handbag_ID = '{$gethidden}'";
            
            if(mysqli_query($dbc, $sql))
            {
                echo "<script>window.location.href='delete_and_edit.php'</script>"; //redirect to delete_and_edit.php
               
            }
        }
        ?>
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