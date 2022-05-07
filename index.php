<?php
require "config.php";

$dsn = "mysql:host=localhost;dbname=cats;charset=UTF8";

$conn = new PDO($dsn, $user, $password);

$getcats = 'SELECT path FROM cat';
$result = $conn->query($getcats);

$catImgArray = [];

while ($row = $result->fetch())
{
    array_push($catImgArray, $row['path']);
}

$catArraylength = count($catImgArray);

$catIdOne = rand(1,$catArraylength);
$catIdTwo = rand(1,$catArraylength);

while ($catIdOne == $catIdTwo) {
    $catIdTwo = rand(1,$catArraylength);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/style.css">
    <title>Catmash</title>
</head>
<body>
    <header>
        <span class="title">CATMASH</span>
    </header>
    <section class="description">
        <h1>Were we let in for our looks? Purrr!!! And will we be judged on them? Purr Purr!</h1>
        <h2>Who is cuter? Paw to choose!</h2>
    </section>
    <form action="" method="POST">
        <section class="imgContainer">
            <?php echo "<button name = {$catIdOne} type='submit'><img src = {$catImgArray[$catIdOne-1]} alt=''></button>"; ?>
            <?php echo "<button name = {$catIdTwo} type='submit'><img src = {$catImgArray[$catIdTwo-1]} alt=''></button>"; ?>
            <?php
            if (isset($_POST)){
                    $imageForUpdate = key($_POST);
                    $updateCats = "UPDATE cat SET rating=rating+1 WHERE id = '".$imageForUpdate."'";
                    $conn->query($updateCats);
            }
            ?>
        </section>
        <section class="topCats">
            <a class="link" href="top.php">CHECK OUT THE TOP 5 CATS!</a>
        </section>
    </form>
</body>
</html>