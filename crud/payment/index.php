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
                   require_once '../../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM payment ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['card_full_name'] . '</td>';
                            echo '<td>'. $row['card_number'] . '</td>';
                            echo '<td>'. $row['card_security'] . '</td>';
                            echo '<td>'. $row['expires_month'] . '</td>';
                            echo '<td>'. $row['expires_year'] . '</td>';
                            echo '<td>'. $row['type'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-default " href="read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
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















