<div class="header">
  <h2>THE BLOG DEMO 1</h2></br>
 <a href="index.php">Home</a>  <a href="create.php">new Posts</a>
</div>
<?php
    $timeStamp = date('Y-m-d H:i:s');
?>
<form action="upload.php" method="post">
	Titel: <input type="text" name="titel"><br>
	<div>
		<label for="TextArea">Hier bitte dein Artikel eintragen.</label><br>
		<textarea id="TextArea" name="article" rows="10" cols="30"></textarea>

		<input type="hidden" name="timeStamp" value="<?php echo $timeStamp; ?>">
	</div>
	Autor: <input type="text" name="Autor"><br>

	<input type="submit">
</form>

