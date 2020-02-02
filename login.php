<?php
 
include('config.php');
//initialize
session_start();
 
if (isset($_POST['login'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
 	//Query db
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    //run query
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['id'] = $result['id'];
            echo '<p class="success">Congratulations, you are logged in!</p>';
            //redirect to homepage
            header("location:http://localhost/projects/registration/homepage.html");
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
 
?>

 <body style='background-color:black'>


<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Username</label>
        <input type="text" onfocus="this.value=''" name="username" pattern="[a-zA-Z0-9]+" required />
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Log In</button>
</form>












