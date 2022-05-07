<?php
require "config.php";

$dsn = "mysql:host=localhost;dbname=cats;charset=UTF8";

$conn = new PDO($dsn, $user, $password);

$getTopCats = "SELECT path, rating from cat WHERE rating<>0 ORDER BY rating DESC LIMIT 5";
$result = $conn->query($getTopCats);

$topCats = [];
$topRating = [];

while ($row = $result->fetch())
{
    array_push($topCats, $row['path']);
    array_push($topRating, $row['rating']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Cats</title>
    <link rel="stylesheet" href="stylesheets/styleTop.css">
</head>
<body>
<header>
    <span class="title">TOP 5 CATS ON THE INTERNET</span>
</header>
    <div class="linkContainer">
        <a class="link" href="index.php"><= Go Back</a>
    </div>
    <div class="imgContainer">
        <?php
            for ($i=0; $i < count($topCats); $i++) {
                echo "<figure>
                <img src={$topCats[$i]}>
                <figcaption>{$topRating[$i]}"." Likes</figcaption>
                </figure>";
            }
        ?>
    </div>
</body>
</html>