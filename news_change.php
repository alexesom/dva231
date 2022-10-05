<?php
session_start();
include('connection.php');

if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] != 'admin') {
        header('Location: index.php');
    }

} else {
    header('Location: sign_in.php');
}


#https://www.php.net/manual/en/features.file-upload.errors.php
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #got the idea of uploading file from this video: https://www.youtube.com/watch?v=JaRq73y5MJk
    if (!empty($_FILES["news-file"])) {
        $file = $_FILES["news-file"];
        $fileName = $file["name"];
        $fileError = $file["error"];
        $fileSize = $file["size"];
        $fileTempLocation = $file["tmp_name"];
        $dividedFileName = explode(".", $file["name"]);
        $fileExtension =
            strtolower(
                end(
                    $dividedFileName
                )
            );

        if ($fileExtension === "json") {
            if ($fileError === 0) {
                if (!file_exists("json/" . $fileName)) {
                    $file = fopen($fileTempLocation, "r");
                    $filesize = filesize($fileTempLocation);

                    if ($filesize !== 0) {
                        $news_json_text = fread($file, $filesize);
                        fclose($file);

                        $news_array = json_decode($news_json_text, true);

                        if(!empty($news_array["news"])) {
                            $empty_flag = false;
                            foreach ($news_array["news"] as $news_piece) {
                                if(empty($news_piece["title"]) || empty($news_piece["content"]) || empty($news_piece["imgurl"])) {
                                    $empty_flag = true;
                                }
                            }

                            if (!$empty_flag) {
                                # code below is to store uploading file to folder
                                #$fileServerLocation = "json/" . $fileName;
                                #move_uploaded_file($fileTempLocation, $fileServerLocation);

                                for ($i = 0; $i < count($news_array["news"]); $i++) {
                                    $news_piece = $news_array["news"][$i];

                                    $image_name = basename($news_piece["imgurl"]);
                                    $image_server_location = "img/news/" . $image_name;

                                    file_put_contents($image_server_location, file_get_contents($news_piece["imgurl"]));

                                    $news_piece["imgurl"] = $image_server_location;

                                    $news_array["news"][$i] = $news_piece;
                                }

                                #https://stackoverflow.com/questions/11320796/saving-json-string-to-mysql-database
                                foreach ($news_array["news"] as $news_piece) {
                                    if ($statement = $connection->prepare('INSERT INTO news_data (title, content, img_path) VALUES (?,?,?)')) {
                                        $statement->bind_param(
                                            "sss",
                                            $news_piece['title'],
                                            $news_piece['content'],
                                            $news_piece['imgurl']);
                                        $statement->execute();
                                        $statement->close();
                                    }
                                }

                                echo "<span class='server-complete'>News where successfully uploaded to database!</span>";
                            } else {
                                echo "<span class='server-error'>Json news file has inappropriate format</span>";
                            }
                        } else {
                            echo "<span class='server-error'>Json news file has inappropriate format</span>";
                        }
                    } else {
                        fclose($file);
                        echo "<span class='server-error'>Json news file is empty</span>";
                    }
                } else {
                    echo "<span class='server-error'>File with this name already exists</span>";
                }
            } else {
                echo "<span class='server-error'>" . $phpFileUploadErrors[$fileError] . "</span>";
            }
        } else {
            echo "<span class='server-error'>Please choose file with .json extension</span>";
        }
    } else {
        echo "<span class='server-error'>Please choose file with .json extension and smth</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="news_change_style.css?v=<?php echo time(); ?>">
    <title>News change</title>
</head>

<body>
<div class="central-container">
    <div class="central-container__formWrapper">
        <div>
            <span>Select the json file to upload</span>
        </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input class="news-json-file__input" type="file" name="news-file" id="formFile">
            <input class="news-json-file__uploadButton" type="submit" value="Upload">
        </form>
    </div>

    <div class="returnHome__link__wrapper">
        <a class="returnHome__link" href="index.php">Go to Index Page</a>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script>
    //https://www.w3schools.com/js/js_cookies.asp
    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setSelectedNewsJson() {
        document.cookie = "news-json-path=" + document.getElementById("news-json").value;
        alert("Json file was successfully chosen.\nPath is: " + getCookie("news-json-path"));
    }
</script>

</html>