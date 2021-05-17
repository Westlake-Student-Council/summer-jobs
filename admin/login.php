<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to dashboard
if(isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true){
    header("location: dashboard.php");
    exit;
}

require_once "../classes/UserLogin.php";

// Define variables and initialize with empty values
$username = "";
$password = "";
$username_error = "";
$password_error = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Instatiate SponsorLogin object
    $obj = new UserLogin();
    
    // Set username
    $username = trim($_POST["username"]);
    $username_error = $obj->setUsername($username);

    // Set password
    $password = trim($_POST["password"]);
    $password_error = $obj->setPassword($password);

    if(empty($username_error) && empty($password_error)){
        $status = $obj->login();
        if(!$status) {
            $password_error = "The password you entered was not valid.";
        }
        else {
            // Start a new session
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();

            // Set session variables
            $_SESSION["user_loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $obj->getUserId();

            // Redirect user to dashboard
            header("location: dashboard.php");
        }
    }
}
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Felix Chen">
    <link rel="icon" href="../assets/images/dog.png">

    <title>Summer Jobs Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/libraries/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../stylesheets/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- <img class="mb-4" src="../assets/images/dog.png" alt="" width="72" height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Summer Jobs</h1>
        
        <label for="username" class="sr-only">Username</label>
        <input id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
        
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
        
        <span class="help-block"><?php echo $username_error; ?></span>
        <span class="help-block"><?php echo $password_error; ?></span>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted">© 2021</p>
    </form>
</body>
</html>