<?php 
$page_title = 'Saving you Registration..';
require_once('header.php');

// store the form inputes in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validation
if (empty($username)){
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)){
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm){
    echo 'Passwords must match<br />';
    $ok = false;
}

// save if the form is ok 
if($ok == true){
    require('db.php'); // connection 
    
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    
    // hash password 
    $hashed_password = hash('sha512', $password);
    
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashed_password, PDO::PARAM_STR, 128);
    $cmd->execute();
    
    $conn = null; // disonnect
    
}
?>

<div class="jumbotron">
<h1> Registration Saved</h1>
<p> You may now login using your personal credentials <a href="login.php" title="Login">Here<i class="fa fa-sign-in"></i></a></P>
</div>

<?php require('footer.php'); ?>