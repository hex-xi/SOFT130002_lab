<?php 

require_once('config.php'); 

/*
 Displays a list of genres
*/
function outputGenres() {
    try {
        //创建PDO实例
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //设置sql语句，从Genres表中查询条目（结果集仅包含GenreId，GenreName, Description属性）并根据GenreID排序
        $sql = 'select GenreId, GenreName, Description from Genres Order By GenreID';
        $result = $pdo->query($sql);

        //遍历结果集
        while ($row = $result->fetch()) {
            outputSingleGenre($row);//单个条目输出
        }
        $pdo = null;
    }catch (PDOException $e) {//异常处理
        die( $e->getMessage() );
    }

}

/*
 Displays a single genre
*/
function outputSingleGenre($row) {
    //设置html
    echo '<div class="ui fluid card">';
    echo '<div class="ui fluid image">';
    //设置img图片地址
    $img = '<img src="images/art/genres/square-medium/' .$row['GenreId'] .'.jpg">';
    //输出包装点击该图片的链接<a>
    echo constructGenreLink($row['GenreId'], $img);
    echo '</div>';
    echo '<div class="extra">';
    echo '<h4>';
    //输出包装点击该图片类别名的链接<a>
    echo constructGenreLink($row['GenreId'], $row['GenreName']);
    echo '</h4>';
    echo '</div>'; // end class=extra
    echo '</div>'; // end class=card

}

/* 
  Constructs a link given the genre id and a label (which could
  be a name or even an image tag
*/
function constructGenreLink($id, $label) {
    //设置链接url，将id值放到其中
    $link = '<a href="genre.php?id=' . $id . '">';
    //将内容包入<a></a>中
    $link .= $label;
    $link .= '</a>';
    return $link;

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 14</title>
    <link href="semantic/semantic.css" rel="stylesheet"> 
  </head>
<body>
<main class="ui container">
      <div class="ui secondary segment">
         <h1>List of Links</h1>
      </div>
      
      <div class="ui segment">  
         <div class="ui six doubling cards">
            <?php outputGenres(); ?>  
         </div>
      </div>            
</main>

</body>
</html>