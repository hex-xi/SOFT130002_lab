<html>
<head>
    <title>Exercise 1</title>
</head>
<body>
<h1>Regular HTML section (outside &lt;?php ... ?&gt; tags)</h1>
<p>You can type regular HTML here and it will show up</p>

<h1>PHP section (inside &lt;?php ... ?&gt; tags)</h1>
<?php
//this is a php comment IN tags (will not appear)
//echo "This was output using PHP";
//echo "<br>"; //notice we must echo tags in php.

//echo "This page was generated: " . date("M dS, Y");

//echo "This page was generated: " . date("M dS, Y") . "<hr/>";

//$d = date("M dS, Y");
//echo "This page was generated: " . $d . "<hr/>";

//$date = date("M dS, Y");
//echo "This page was generated: " . $date . "<hr/>";

//echo date('l \, F jS \, Y h:i:s');


$remaining = 365 - date("z");
//判断是否闰年
$year = date('Y');
$isLeap = false;
if($year %4 ==0 && $year%100!=0){//普通闰年
    $isLeap = true;
}else if($year%400==0){ //世纪闰年
    $isLeap = true;
}
//闰年+1天
if($isLeap){
    $remaining++;
}
echo "There are ". $remaining . " days left in the year";

?>
</body>
</html>