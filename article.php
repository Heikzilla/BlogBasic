<div class="header">
  <h2>THE BLOG DEMO 1</h2></br>
 <a href="index.php">Home</a>  <a href="create.php">new Posts</a></br>
</div>
<?php
require_once 'DB.php';

$run = new DB();

$article = $run->readAll($_GET['id']);

$tile = $article[0]['Title'];
$text = $article[0]['Text'];
$autor = $article[0]['Autor'];
$timestamp = $article[0]['TIMESTAMP'];

$divString =
"<div>
    <h1>$tile</h1></br>
    $text</br>
    $autor $timestamp</br>
</div>";

echo $divString; 

$comment = $run->readComment($_GET['id']);

function convertArray($result) {
    $divString = '';

    foreach ($result as $base => $value){
       
        for ($i = 0; $i < (count($result[$base])/2); $i++) {
            $string .= $result[$base][$i] . "</br>";
        }
        
        $divString .=
        "<div> " . 
            $string
        . " </div>";
            
    }
    
    return $divString;
}

echo convertArray($comment);
?>

<form action="upload.php" method="post">
	<div>
		My Comment: <textarea id="TextArea" name="comment" rows="10" cols="30"></textarea>
		<input type="hidden" name="articleID" value="<?php echo $_GET['id']; ?>">
		<input type="hidden" name="timeStamp" value="<?php echo date('Y-m-d H:i:s'); ?>">
	</div>
		Name: <input type="text" name="UserName"><br>
		<input type="submit">
</form>