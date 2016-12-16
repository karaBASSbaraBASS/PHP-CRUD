<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customers  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script type='text/javascript' src="js/jquery-3.1.1.min.js"></script>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
</head>
 
<body>
   
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">  
            <div class="row">
              <h3>Delete the Customer</h3>
            </div>
          </div>
        </div>
      </nav> 

    <div class="container">
                <div class="span10 offset1">      
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-danger">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn btn-default" href="index.php">No</a>
                        </div>
                    </form>
                </div>     
    </div> <!-- /container -->
  </body>
</html>