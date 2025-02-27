<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>This is your edit page</h1>
    <p>
        <?php

        // $array = ["title" => "hi", "body" => "jsjs"];

        foreach ($ss as $s) {
            echo $s;
            echo "<br>";  // Adding a line break for readability in the output.
        }
        ?>
    </p>
</body>

</html>