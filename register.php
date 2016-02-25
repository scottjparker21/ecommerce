<?php	 
   require_once 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $firstError = null;
        $lastError = null;
        $phoneError = null;
        $dobError = null;
        $usernameError = null;
        $passwordError = null;
        $genderError = null;
        $permissionError = null;
        $emailError = null;
         
        // keep track post values
        $first = $_POST['first'];
        $last = $_POST['last'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $permission = $_POST['permission'];
        $email = $_POST['email'];
         
        // validate input
        $valid = true;
        if (empty($first)) {
            $firstError = 'Please enter First name';
            $valid = false;
        }
         
        if (empty($last)) {
            $lastError = 'Please enter Last name';
            $valid = false;
        } 
         
        if (empty($phone)) {
            $phoneError = 'Please enter Phone';
            $valid = false;
        }

        if (empty($dob)) {
            $firstError = 'Please enter Date of Birth';
            $valid = false;
        }

        if (empty($username)) {
            $usernameError = 'Please enter Username';
            $valid = false;
        }

        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        }

        if (empty($gender)) {
            $genderError = 'Please enter Gender';
            $valid = false;
        }

        if (empty($permission)) {
            $permissionError = 'Please enter Permission';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email';
            $valid = false;
        }
         
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customer (first,last,phone,dob,username,password,gender,permission,email) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($first,$last,$phone,$dob,$username,$password,$gender,$permission,$email));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<?php require_once 'session.php' ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'header.php'; ?>
		<body>
		<?php require_once 'navbar.php'; ?>
			<div class="container">
			  	<div class="span10 offset1">
                    <div class="row">
                        <h3>Create an Account</h3>
                    </div>           
                    <form class="" action="register.php" method="post" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">First name</label>
                        <div class="controls">
                            <input name="first" type="text"  placeholder="First name" value="<?php echo !empty($first)?$first:'';?>">
                            <?php if (!empty($firstError)): ?>
                                <span class="help-inline"><?php echo $firstError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lastError)?'error':'';?>">
                        <label class="control-label">Last name</label>
                        <div class="controls">
                            <input name="last" type="text" placeholder="Last name" value="<?php echo !empty($last)?$last:'';?>">
                            <?php if (!empty($lastError)): ?>
                                <span class="help-inline"><?php echo $lastError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="phone" type="text" placeholder="Phone" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dobError)?'error':'';?>">
                        <label class="control-label">Date of Birth</label>
                        <div class="controls">
                            <input name="dob" type="text"  placeholder="Date of Birth" value="<?php echo !empty($dob)?$dob:'';?>">
                            <?php if (!empty($dobError)): ?>
                                <span class="help-inline"><?php echo $dobError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                        <label class="control-label">Username</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($genderError)?'error':'';?>">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <input name="gender" type="text"  placeholder="Gender" value="<?php echo !empty($gender)?$gender:'';?>">
                            <?php if (!empty($genderError)): ?>
                                <span class="help-inline"><?php echo $genderError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($permissionError)?'error':'';?>">
                        <label class="control-label">Permission</label>
                        <div class="controls">
                            <input name="permission" type="text"  placeholder="Permission" value="<?php echo !empty($permission)?$permission:'';?>">
                            <?php if (!empty($permissionError)): ?>
                                <span class="help-inline"><?php echo $permissionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="text"  placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>    
		<?php require_once 'footer.php';?>
		</body>
	</html>