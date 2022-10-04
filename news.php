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
    <div class="news__wrapper">
        <div class="news__title">
            <h1><?php echo $title ?></h1>
        </div>

        <div class="news__img">
            <img src="<?php echo $img_path ?>" alt="someImg.jpg">
        </div>

        <div class="news__content">
            <p><?php echo $content ?></p>
        </div>
    </div>
</body>

</html>