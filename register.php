<?php

session_start();
include('connection.php');

if(isset($_SESSION['username']))
{
    header('Location:index.php');
}

$username = $password = '';

$check = true;

if(isset($_POST['submit']))
{

    if(strlen($_POST['password'])>=5)
    {
        $password = $_POST['password'];
        $encryptedPass = password_hash($password,PASSWORD_BCRYPT);
    }else{
        $check = false;
        echo "<script>alert('Password should be 5 letters or more!')</script>";
    }

    if (!empty($_POST['username']))
    {
        $username = $_POST['username'];
    }else{
        echo "<script>alert('Please type in your username!')</script>";
        $check = false;
    }

    if($check)
    {
        $checkSql = "SELECT * FROM users WHERE username = '$username'";
        $execute = $connection ->query($checkSql);

        if($execute->num_rows >0)
        {
            echo "<script>alert('Username taken!')</script>";
        }else{
            $sqlPrep = $connection -> prepare("INSERT INTO users (username, password) values (?,?);");
            
            $sqlPrep -> bind_param('ss', $username, $encryptedPass);

            if($sqlPrep->execute())
            {
                header('Location: sign_in.php');
            }else{
                die('Error! '. $connection -> error);
            }
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_in.css?v=<?php echo time(); ?>">
    <title>Register</title>
</head>

<body>
    <main>
        <div id="main">

            <form id="survey__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="sign__in__title">
                    <h1>Register</h1>
                </div>

                <div class="form__div">
                    <label id="username__label" for="username">Username</label>
                    <input class="form__element" type="text" name="username" id="username"
                        placeholder="Enter your username" required />
                </div>

                <div class="form__div">
                    <label id="password__label" for="password">Password</label>
                    <input class="form__element" type="password" name="password" id="password"
                        placeholder="Enter Your Password" required />
                </div>


                <div class="btn__login__div">
                    <div class="form__div">
                        <button type="submit" id="submit" name="submit" class="form__submit">Submit</button>
                    </div>

                    <div class="register__div">
                        <input type="button" value="Sign In" name="register" id="reg__btn" class="form__submit"
                            onclick="window.location.href='sign_in.php'" />
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