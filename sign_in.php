<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}




if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    if ($username == 'admin' && $password =='admin') {

        $_SESSION["username"] = $username;
        header("Location:news_change.php"); 

        }else {
        echo "<script>alert('This is not an admin account. (user: admin, pass:admin')</script>";
    }


}

?>



 <!-- PHP END 




-->
<!-- HTML START -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  <?php include "sign_in.css" ?>
</style>
    <title>Sign In</title>
</head>
<body>

<header class="main-header">
 
</header>
<main>

    

    <div id="main">
        
        <form id="survey-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="reg-title">
        <h1>Sign In</h1>
    </div>
            <div class="form-div">
                <label id="username-label" for="username">Username</label>
                <input
                        class="form-element"
                        type="text"
                        name="username"
                        id="username"
                        placeholder="Enter your username"
                        required
                />
            </div>

            <div class="form-div">
                <label id="password-label" for="password">Password</label>
                <input
                        class="form-element"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter Your Password"
                        required
                />
            </div>
            <div class="btn-login-div">
                <div class="form-div">
                    <button type="submit" id="submit" name="submit" class="form-submit">Log In</button>
                </div>
                <div class="redirect-div">

                    <input type="button" value="Register" name="register" id="reg-btn" class="form-submit"/>
                </div>
            </div>


        </form>

    </div>



</main>


</body>
</html>