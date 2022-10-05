<?php
session_start();
include('connection.php');

if (isset($_POST['recieved'])) {
    $ajax__dropdown = "<ul><li>No news found!</li></ul>";


    $searchInput = $connection->real_escape_string($_POST['query']);


    $sqlStr = "SELECT * FROM news_data WHERE title LIKE '%$searchInput%' LIMIT 5";
    $execute = $connection->query($sqlStr);
    if ($execute->num_rows > 0) {
        $ajax__dropdown = "<ul>";
        while ($data = $execute->fetch_assoc()) {
            $ajax__dropdown .= "<li>" . "<a href='news.php?id=" . $data['id'] . "'>";

            if (strlen($data['title']) < 45) {
                $ajax__dropdown .= $data['title'] . "</a></li>";
            } else {
                $ajax__dropdown .= substr($data['title'], 0, 45) . "..." . "</a></li>";
            }
        }
        $ajax__dropdown .= "</ul>";
    }
    exit($ajax__dropdown);
}
?>