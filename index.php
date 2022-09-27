<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <title>NASA</title>
</head>

<body>
    <?php
        $news_uri = "";

        if (isset($_COOKIE["news-uri"])) 
        {
            $news_uri = $_COOKIE["news-uri"];
        } else {
            $news_uri = "json/Ass2News.json";
        }

        $file = fopen($news_uri, "r");
        $filesize = filesize($news_uri);
        $news_json_text = fread($file, $filesize);
        fclose($file);

        $news_data = json_decode($news_json_text);

        echo $news_data->news[0]->title;
    ?>
    <header class="header--fixed">
        <div class="logo">
            <img src="https://www.nasa.gov/sites/all/themes/custom/nasatwo/images/nasa-logo.svg" alt="nasa-logo.jpg">
        </div>

        <nav class="navbar__wrapper">
            <ul class="navbar">
                <li> <a href="#">Missions</a></li>
                <li> <a href="#">Galleries</a></li>
                <li> <a href="#">NASA TV</a></li>
                <li> <a href="#">Follow NASA</a></li>
                <li> <a href="#">Downloads</a></li>
                <li> <a href="#">About</a></li>
                <li> <a href="#">NASA Audiences</a></li>
            </ul>

            <form class="search-form" action="/search" method="get">
                <div class="search-form__wrapper">
                    <input class="search-form__searchBar" type="text" placeholder="Search..">
                    <button class="search-form__submit" type="submit">
                        <i class="uil uil-search"></i>
                    </button>
                    <a class="search-form__share">
                        <i class="uil uil-share-alt"></i>
                    </a>
                </div>
            </form>
        </nav>

        <div class="topics-navbar__wrapper">
            <ul class="topics-navbar">
                <li><a href="#">International Space Station</a></li>
                <li><a href="#">Journey to Mars</a></li>
                <li><a href="#">Earth</a></li>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Aeronautics</a></li>
                <li><a href="#">Solar Space System and Beyond</a></li>
                <li><a href="#">Education</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Benifits to you</a></li>
            </ul>


            <?php
          if(isset($_SESSION['username']))
          {
            
            if($_SESSION['username'] == 'admin')
            {
                echo "<button class='topics-navbar__button' onclick=" . "\""."window.location.href='news_change.php'"."\"".">
            Change News
        </button>";
            }

            echo "<button class='topics-navbar__button' onclick=" . "\""."window.location.href='logout.php'"."\"".">
        Log Out, ".$_SESSION['username']."
        </button>";

          } else {
            echo "<button class='topics-navbar__button' onclick=" . "\""."window.location.href='sign_in.php'"."\"".">
            Change News
        </button>";

            echo "<button class='topics-navbar__button' onclick=" . "\""."window.location.href='sign_in.php'"."\"".">
            Sign in
        </button>";
          }
          ?>
        </div>
    </header>
    <section class="news">
        <div class="news0 headlines" onclick="nextSlide()">
            <div class="slide active fade">
                <div class="slide-text">
                    <div class="slide-text__title">Lorem, ipsum 1</div>
                    <div class="slide-text__description">Quod deleniti laboriosam cupiditate dolor sit amet consectetur
                        adipisicing elit.</div>
                </div>
            </div>
            <div class="slide fade">
                <div class="slide-text">
                    <div class="slide-text__title">Lorem, ipsum 2</div>
                    <div class="slide-text__description">Quod deleniti laboriosam cupiditate dolor sit amet consectetur
                        adipisicing elit.</div>
                </div>
            </div>
            <div class="slide fade">
                <div class="slide-text">
                    <div class="slide-text__title">Lorem, ipsum 3</div>
                    <div class="slide-text__description">Quod deleniti laboriosam cupiditate dolor sit amet consectetur
                        adipisicing elit.</div>
                </div>
            </div>
        </div>
        <div class="news1">
            <div class="news1__wrapper">
                <div class="news1__txt">
                    <h5><?php echo $news_data->news[0]->title ?></h5>
                    <p><?php echo $news_data->news[0]->content ?></p>
                </div>

                <ul class="news1__ul">
                    <li><a href="#">Calendar</a></li>
                    <li><a href="#">Launches and Landings</a></li>
                </ul>
            </div>
        </div>

        <div id="news2" class="news2">
            <img id="news2__img" src="<?php echo $news_data->news[1]->imgurl ?>" alt="This is a nice image!">
            <span id="news2__headline" class="news2__headline" onmouseover="hoverNews()">
                <h4><?php echo $news_data->news[1]->title ?></h4>
                <p id="news2__headline__p"><b>NASA's Astronaut Return to Earth.</b></p>
            </span>
            <span id="news2__txt" class="news2__txt">
                <p>
                    <?php echo $news_data->news[1]->content ?>
                </p>
            </span>
        </div>

        <div class="news3">
            <div class="news3__image">
                <img src="<?php echo $news_data->news[2]->imgurl ?>" alt="This is a nice image!">
                <div class="news3__whiteSquare"></div>
            </div>
            <div class="news3__txt">
                <h4><?php echo $news_data->news[2]->title ?></h4>
                <p><?php echo $news_data->news[2]->content ?></p>
                <ul class="news3__linksList">
                    <li><a href="#">Mission Site</a></li>
                    <li><a href="#">Briefing Schedule</a></li>
                    <li><a href="#">Launch Updates</a></li>
                    <li><a href="#">Video: To Bennu and Back</a></li>
                </ul>
            </div>
        </div>

        <div class="news4">
            <iframe class="news4__youtubeVideo" src="https://www.youtube.com/embed/rB2RAEbuI6o"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>

        <div class="news5">
            <a href="#"><img src="./img/oceans.jpg" alt="oceans.jpg"></a>
        </div>

        <div class="news6">
            <a class="twitter-timeline" data-theme="dark" href="https://twitter.com/NASA?ref_src=twsrc%5Etfw">Tweets by
                NASA</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </section>

    <footer></footer>
    <script src="script.js"></script>
</body>

</html>