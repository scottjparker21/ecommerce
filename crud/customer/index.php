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
                <h3>Customer</h3>
            </div>
            <div class="row">
		<p>
			<a href="create.php" class="btn btn-success"> Create </a>
		</p>		
                <table class="table table-striped table-bordered" style="white-space:nowrap;">
                  <thead>
                    <tr>
                      <th>First</th>
                      <th>Last</th>
		                  <th>Phone</th>
                      <th>Date of Birth</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Gender</th>
                      <th>Permission</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once '../../includes/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM customer ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<form action="update.php" method="post">';

                            echo '<td><input type="text" name="first" value="' . $row["first"] . '"></td>';
                            echo '<td><input type="text" name="last" value="' . $row["last"] . '"></td>';
                            echo '<td><input type="text" name="phone" size="12" value="' . $row["phone"] . '"></td>';
                            echo '<td><input type="text" name="dob" value="' . date('m-d-Y',strtotime($row["dob"])) . '"></td>';
                            echo '<td><input type="text" name="username" value="' . $row["username"] . '"></td>';
                            echo '<td><input type="text" name="password" value="' . $row["password"] . '"></td>';
                            echo '<td><input type="text" name="gender" size="1" value="' . $row["gender"] . '"></td>';
                            echo '<td><input type="text" name="permission" size="1" value="' . $row["permission"] . '"></td>';
                            echo '<td><input type="text" name="email" value="' . $row["email"] . '"></td>';
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















