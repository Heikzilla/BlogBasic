<?php
require_once 'DB.php';

$run = new DB();
if (array_key_exists('article', $_POST)) {
    if ("" == trim($_POST['article'])) {
        die("ERROR: Article field is empty");
    } else {
        $text = $_POST['article'];
    }
    
    if ("" == trim($_POST['Autor'])) {
        $autor = 'Anonymous';
    }else {
        $autor = $_POST['Autor'];
    }
    
    $title = $_POST['titel'];
    $timestamp = $_POST['timeStamp'];
    
    $id = $run->writeArticle($title, $text, $autor, $timestamp);
    
    header("Location: article.php?id=" . $id);

}elseif (array_key_exists('comment', $_POST)){
    
    if ("" == trim($_POST['comment'])) {
        die("ERROR: Comment field is empty");
    } else {
        $text = $_POST['comment'];
    }
    
    if ("" == trim($_POST['UserName'])) {
        $userName = 'Anonymous';
    }else {
        $userName = $_POST['UserName'];
    }
    
    $articleID = $_POST['articleID'];
    $timestamp = $_POST['timeStamp'];
    
    $id = $run->writeComment($articleID, $text, $userName, $timestamp, "commentmysql");
    
    header("Location: article.php?id=" . $id);
}


?>