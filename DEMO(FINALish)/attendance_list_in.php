<?php 
    date_default_timezone_set("America/New_York");
    $d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));
    $date = date("Y-m-d", $d)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>LOGGED IN</title>
</head>
<body>
    <h1>ATTENDANCE LIST: LOGGED IN</h1>
    <h2>Date: <?php echo $date ?></h2>
</body>
</html>