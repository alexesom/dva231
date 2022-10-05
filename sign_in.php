<?php
session_start();
include('connection.php');


if (isset($_SESSION['username'])) {
    header('Location: index.php');
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $execute = $connection->query($query);

    if ($execute->num_rows > 0) {
        while ($row = $execute->fetch_assoc()) {
            $encryptedPassDb = $row['password'];

            if (password_verify($password, $encryptedPassDb)) {
                $_SESSION["username"] = $username;
                header("Location: index.php");
            } else {
                echo "<script>alert('Wrong password!')</script>";
            }
        }
    } else {
        echo "<script>alert('This account does not exist!')</script>";
    }

}
?>

<!-- HTML START -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_in.css?v=<?php echo time(); ?>">
    <title>Sign In</title>
</head>

<body>
<main>
    <div id="main">

        <form id="survey__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="sign__in__title">
                <h1>Sign In</h1>
            </div>

            <div class="form__div">
                <label id="username__label" for="username">Username</label>
                <input class="form__element" type="text" name="username" id="username"
                       placeholder="Enter your username" required/>
            </div>

            <div class="form__div">
                <label id="password__label" for="password">Password</label>
                <input class="form__element" type="password" name="password" id="password"
                       placeholder="Enter Your Password" required/>
            </div>

            <div class="btn__login__div">
                <div class="form__div">
                    <button type="submit" id="submit" name="submit" class="form__submit">Sign In</button>
                </div>

                <div class="register__div">
                    <input type="button" value="Register" name="register" id="reg__btn" class="form__submit"
                           onclick="window.location.href='register.php'"/>
                </div>
            </div>
        </form>
        <div class="index__link">
            <a href="index.php">Back to Home Page</a>
        </div>
    </div>
</main>

</body>

</html>