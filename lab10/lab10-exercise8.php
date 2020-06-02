<?php 

require_once('config.php'); 

/*
  在页面的侧边显示艺术家的链接list
*/
function outputArtists() {
   try {
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);//根据配置文件创建PDO类的实例
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//设置属性：错误及异常抛出
       //设置sql语句，在Artists表钟查询从0行开始的30条数据，将结果按照LastName排序
         $sql = "select * from Artists order by LastName limit 0,30";
         $result = $pdo->query($sql);//执行查询，并且获得结果集
         while ($row = $result->fetch()) {//遍历条目
             //输出到html，创建链接  "当前脚本的路径?id=艺术家ID"
            echo '<a href="' . $_SERVER["SCRIPT_NAME"] . '?id=' . $row['ArtistID'] . '" class="';
            //如果这个id已经点击过了则把class +活跃状态
            if (isset($_GET['id']) && $_GET['id'] == $row['ArtistID']) echo 'active ';
            echo 'item">';//类 +item
            echo $row['LastName'] . '</a>';//显示文本是LastName
         }
         $pdo = null;//释放内存
   }
   catch (PDOException $e) {//异常处理
      die( $e->getMessage() );
   }
}

/*
 根据特定艺术家的ID（点击的id）显示画作的list
*/
function outputPaintings() {
    try {
        if (isset($_GET['id']) && $_GET['id'] > 0) {//判断设置过id(点击链接跳转时)
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);//new PDO类
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//设置错误...
            //设置sql语句，在Paintings表中，根据ArtistId(当==特定艺术家id时)查询所有信息
            $sql = 'select * from Paintings where ArtistId=' . $_GET['id'];
            $result = $pdo->query($sql);//获得结果集
            while ($row = $result->fetch()) {//遍历条目
                outputSinglePainting($row);//单个输出画作
            }
            $pdo = null;//释放内存
        }
    }catch (PDOException $e) {//异常处理
        die( $e->getMessage() );
    }
}

/*
 显示单个画作
*/
function outputSinglePainting($row) {
    //输出html
    echo '<div class="item">';
    echo '<div class="image">';
    //设置图片的路径（通过条目的ImageFileName）
    echo '<img src="images/art/works/square-medium/' .$row['ImageFileName'] .'.jpg">';
    echo '</div>';
    echo '<div class="content">';
    echo '<h4 class="header">';
    //设置图片的标题（通过条目的Title）
    echo $row['Title'];
    echo '</h4>';
    echo '<p class="description">';
    //设置图片的介绍（通过条目的Excerpt）
    echo $row['Excerpt'];
    echo '</p>';
    echo '</div>'; // end class=content
    echo '</div>'; // end class=item

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
         <h1>User Input</h1>
      </div>
      <div class="ui segment">
          <div class="ui grid">
              <div class="four wide column">
                  <div class="ui link list">
                      <?php outputArtists(); ?>
                  </div>
              </div>
              <div class="twelve wide column">
                  <div class="ui items">
                      <?php outputPaintings(); ?>
                  </div>
              </div>
          </div>

      </div>
   </main>

</body>
</html>
