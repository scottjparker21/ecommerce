
<?php
    require_once '../../includes/database.php';
 
   $id = $_POST['id'];
     
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
        $id = $_POST['id'];
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
            $phoneError = 'Please enter Phone number';
            $valid = false;
        }

         if (empty($dob)) {
            $phoneError = 'Please enter Date of Birth';
            $valid = false;
        }

         if (empty($username)) {
            $phoneError = 'Please enter Username';
            $valid = false;
        }

         if (empty($password)) {
            $phoneError = 'Please enter Password';
            $valid = false;
        }

         if (empty($gender)) {
            $phoneError = 'Please enter Gender';
            $valid = false;
        }

         if (empty($permission)) {
            $phoneError = 'Please enter Permission';
            $valid = false;
        }

         if (empty($email)) {
            $phoneError = 'Please enter Email';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customer set first = ?, last = ?, phone = ?, dob = ?, username = ?, password = ?, gender = ?, permission = ?, email = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($first,$last,$phone,$dob,$username,$password,$gender,$permission,$email,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customer where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $first = $data['first'];
        $last = $data['last'];
        $phone = $data['phone'];
        $dob = $data['dob'];
        $username = $data['username'];
        $password = $data['password'];
        $gender = $data['gender'];
        $permission = $data['permission'];
        $email = $data['email'];
        Database::disconnect();

    }
?>
