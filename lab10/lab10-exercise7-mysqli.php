
<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
<body>
<h1>Database Tester (mysqli)</h1> Genre:
<select>
    <?php
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if ( mysqli_connect_errno() ) {
        die( mysqli_connect_error() );
    }
    $sql = "select * from Genres order by GenreName";
    if ($result = mysqli_query($connection, $sql)) {
        // loop through the data
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['GenreID'] . '">';
            echo $row['GenreName'];
            echo "</option>";
        }
        // 释放 result set内存
        mysqli_free_result($result);
    }
    //关闭连接 database connection
    mysqli_close($connection);
    ?>
</select>
</body>
</html>
