<?php 
        $path = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $path = $_POST["news-uri"];

          if(file_exists($path)) {
            header("Location: " . "index.php");
            setcookie("news-uri", $path);
            die();
          } else {
            $path = "not exist";
          }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news_change_style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>News change</title>
</head>
<body>
  <div class="form__wrapper">
    <?php if ($path === "not exist" && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
      <h2 class="warning-header">File unfortunately hasn't been found. <br> Please try again</h2>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <input class="form-control" type="text" name="news-uri">
      <input class="btn btn-outline-primary" type="submit" value="Submit path">
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>