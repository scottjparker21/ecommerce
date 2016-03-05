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
                <h3>Bin</h3>
            </div>
            <div class="row">
		<p>
			<a href="create.php" class="btn btn-success"> Create </a>
		</p>		
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Shipment Center id</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once '../../includes/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM bin ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<form action="update.php" method="post">';

                            echo '<td><input type="text" name="name" value="' . $row["name"] . '"></td>';
                            
                            echo '<td>';

                            echo '<select name="shipment_center_id">';
                            echo '<option name="shipment_center_id" value="' . $row["shipment_center_id"] . '">' . $row["shipment_center_id"] . '</option>';
                           
                            $sql2 = 'SELECT * FROM shipment_center ORDER BY id DESC';                         
                              foreach ($pdo->query($sql2) as $row2) {

                                if ($row["shipment_center_id"] != $row2["id"]){
                                echo '<option name="shipment_center_id" value="' . $row2["id"] . '">' . $row2["id"] . '</option>';
                              }
                            }
                                
                            echo '</select>';
                            echo '</td>';
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















