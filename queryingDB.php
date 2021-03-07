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

            include 'include/db_credentials.php';
            $sql = "SELECT * FROM category";
	        $results = sqlsrv_query($con, $sql, array());
            echo "<table><tr><th>CategoryId</th><th>Category Name</th></tr>";
            while ($row = sqlsrv_fetch_array( $results, SQLSRV_FETCH_ASSOC)) {
                echo("<tr><td>" . $row['categoryId'] . "</td><td>" . $row['categoryName'] . "</td></tr>");
            }
            echo "</table>";

            
            ?>
                <script src="" async defer></script>
        </body>
</html>