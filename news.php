<?php
session_start();
include('connection.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $sqlStr = "SELECT * FROM news_data WHERE id='$id'";

    $execute = $connection->query($sqlStr);

    $row = $execute ->fetch_assoc();

    $title = $row['title'];
    $content = $row['content'];
    $img_path = $row['img_path'];
    
}else{
    header("Location: index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news.css?v=<?php echo time(); ?>">
    <title><?php echo $title?></title>
</head>

<body>
    <div class="index__link">
        <a href="index.php">Back to Home Page</a>
    </div>
    <div class="news__wrapper">
        <?php
            if(!empty($img_path))
            {
                echo "<div class='news__img'>";
                echo "<img src='$img_path' alt='someImg.jpg'>";
                echo "</div>";
            }
        ?>

        <div class="news__text">
            <h1><?php echo $title ?></h1>
            <p><?php echo $content ?></p>
        </div>



    </div>

</body>

</html>