<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Address</h3>
            </div>
            <div class="row">
		<p>
			<a href="create.php" class="btn btn-success"> Create </a>
		</p>		
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>City</th>
                      <th>State</th>
                      <th>Zip</th>
                      <th>Street 1</th>
                      <th>Street 2</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once '../../includes/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM address ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<form action="update.php" method="post">';

                            echo '<td><input type="text" name="city" value="' . $row["city"] . '"></td>';
                            echo '<td><input type="text" name="state" value="' . $row["state"] . '"></td>';
                            echo '<td><input type="text" name="zip" size="12" value="' . $row["zip"] . '"></td>';
                            echo '<td><input type="text" name="street_1" value="' . $row["street_1"] . '"></td>';
                            echo '<td><input type="text" name="street_2" value="' . $row["street_2"] . '"></td>';
                            echo '<input type="hidden" name="id" value="'.$row["id"].'">';
            
                            echo '<td>';
                              echo '<input type="submit" class="btn-success" value="update">';
                              echo '</form>';
          
                              echo '<form action="delete.php" method="post">';
                              echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                              echo '<input type="submit" class="btn-danger" value="delete">';
                              echo '</form>';
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















