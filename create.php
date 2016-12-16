<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $mobileError = null;
        $emailError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
         
        // validate input

        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        $valid = true;
        if (empty($address)) {
            $addressError = 'Please enter Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
         
         if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (name,address,mobile,email) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$address,$mobile,$email));
            Database::disconnect();
            header("Location: index.php");
        }
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
              <h3>Create a Customer</h3>
            </div>
          </div>
        </div>
      </nav>

    <div class="container">
      <div class="span10 offset1">  
            <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'alert-danger':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" size="50" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'alert-danger':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="address" size="50" type="text" placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'alert-danger':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" size="50" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'alert-danger':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" size="50" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions" style="margin-top: 20px">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-default" href="index.php">Back</a>
                      </div>
            </form>
      </div>            
    </div> <!-- /container -->
  </body>
</html>