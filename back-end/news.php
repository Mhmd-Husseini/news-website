<?php

$mysqli = new mysqli("localhost", "root", null, "newswebsite_db");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$category = $_GET['category'];

if ($category == 'all') {
  $sql = "SELECT news.timestamp, news.header, news.detailed 
  FROM news JOIN categories ON news.category_id = categories.id 
  ORDER BY n.timestamp DESC";
} else {
  $sql = "SELECT news.timestamp, news.header, news.detailed 
  FROM news JOIN categories ON news.category_id = categories.id 
  WHERE categories.name = '$category' ORDER BY news.timestamp DESC";
}

$result = $mysqli->query($sql);

$news = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($news, $row);
  }
}

header('Content-Type: application/json');
echo json_encode($news);
?>
