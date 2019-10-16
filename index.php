<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>Blog Index header</head>
<body>
<div class="header">
  <h2>THE BLOG DEMO 1</h2></br>
   <a>Home</a>  <a href="create.php">new Posts</a></br>
</div>

<?php
require_once 'DB.php';

$run = new DB();
echo "<h1>Welcome to Index</h1> \n";
$article = $run->readAll();

function convertArray($result) {
    $divString = '';
    
    foreach ($result as $base => $value){
        $articleID = $result[$base]['ArticleID'];
        $tile = $result[$base]['Title'];
        $text = $result[$base]['Text'];
        $autor = $result[$base]['Autor'];
        $timestamp = $result[$base]['TIMESTAMP'];
        
        $link ="article.php?id=" . $articleID;

        $divString .= 
        "<div>
            <a href=" . $link . "><h1>$tile</h1></a></br>
            $text</br>
            $autor $timestamp</br>
        </div>";

    }
    
    return $divString;
}

echo convertArray($article);
?>
</body>
</html>