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
            <h3>PHP CRUD Grid</h3>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row">
              <a href="create.php" class="btn btn-warning">+ Add new line</a>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th> 
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Email Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM customers ORDER BY id DESC';
                    foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['address'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td width=160>';
                            echo '<a class="btn btn-success" href="update.php?id='. $row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='. $row['id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                  </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>