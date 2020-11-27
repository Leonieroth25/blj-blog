<?php
$dbuser = "d041e_listuder";
$dbpass = "12345_Db!!!";

$pdo = new PDO("mysql:host=mysql2.webland.ch;dbname=d041e_listuder", $dbuser, $dbpass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
echo '<h1>Blogs meiner BLJ-Kollegen</h1>';
$sqlQuery = $pdo->query("SELECT * FROM `blog_url`");
$urls = $sqlQuery->fetchAll();

foreach($urls as $url) {
    $link = '<a href="' . $url["blogUrl"] . '" target="_blank">' . $url["blogAuthor"] . ''s Blog' . '</a>' . '<br>';

   echo $link;
} 



var_dump($urls);


echo '<h1>Blogs meiner BLJ-Kollegen</h1>';




?>

