<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Tag</h3>
            </div>
            <div class="row">
		<p>
			<a href="create.php" class="btn btn-success"> Create </a>
		</p>		
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
		    </tr>
                  <tbody>
                  <?php
                   require_once '../../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tag ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                      echo '<tr>';
                            echo '<form action="update.php" method="post">';
                            echo '<td><input type="text" name="name" value="' . $row["name"] . '"></td>';
                                                            
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















