<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php
        echo "<div align='center'";
        foreach(glob("*.php") as $file){
            if( filetype($file) == "file"){
                echo "<a style='font-size:180%' href='".$file."'>".$file."</a><br>";
            }
        }
        foreach(glob("*.html") as $file){
            if( filetype($file) == "file"){
                echo "<a style='font-size:180%' href='".$file."'>".$file."</a><br>";
            }
        }
        echo "</div>";
        ?>
        <script src="" async defer></script>
    </body>
</html>