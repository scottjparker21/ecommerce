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
                <h3>Payment</h3>
            </div>
            <div class="row">
		<p>
			<a href="create.php" class="btn btn-success"> Create </a>
		</p>		
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Card Number</th>
                      <th>Security Number</th>
                      <th>Expiration Month</th>
                      <th>Expiration Year</th>
                      <th>Type</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once '../../includes/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM payment ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<form action="update.php" method="post">';

                            echo '<td><input type="text" name="card_full_name" value="' . $row["card_full_name"] . '"></td>';
                            echo '<td><input type="text" name="card_number" value="' . $row["card_number"] . '"></td>';
                            echo '<td><input type="text" name="card_security" size="3" value="' . $row["card_security"] . '"></td>';
                            echo '<td><input type="text" name="expires_month" size="2" value="' . $row["expires_month"] . '"></td>';
                            echo '<td><input type="text" name="expires_year" size="4" value="' . $row["expires_year"] . '"></td>';
                            echo '<td><input type="text" name="type" value="' . $row["type"] . '"></td>';
                            
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















