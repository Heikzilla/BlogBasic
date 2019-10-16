<?php

class DB
{

    private $dbType = 'mysql';

    #private $host = '127.0.0.1';
    private $host = 'localhost';
    
    private $port = '3306';

    private $dbname = 'BlogDB';

    private $user = 'root';

    private $pass = '';

    function connect()
    {
        //echo "Start Programm.</br>";
        try {
            $dsn = "$this->dbType:host=$this->host;dbname=$this->dbname;port=$this->port";
            $conn = new PDO($dsn, $this->user, $this->pass);
            
            /*
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $abfrage = $conn->query('SHOW TABLES;');
            var_dump($abfrage->fetch());
            */
            
            //echo "Connected successfully.</br>";
            return $conn;
        } catch (PDOException $e) {
            print "Error connect!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function writeArticle($title, $text, $autor, $timestamp, $table = "Articlesmysql") {
        
        $insert = "INSERT INTO $table (Title, Text, Autor, TIMESTAMP)";
        $insert .= "VALUES('$title','$text','$autor', '$timestamp');";
        $conn = $this->connect();
        
        try {
            $conn->query($insert);
            $articleId = $conn->lastInsertId();
            
            return $articleId;
            
        } catch (PDOException $e) {
            print "Error createEntry()!: " . $e->getMessage() . "<br/>";
        }
        
    }
    
    function writeComment($articleID, $text, $autor, $timestamp, $table = "commentmysql") {
        
        $insert = "INSERT INTO $table (ArticleID, Text, Autor, TIMESTAMP)";
        $insert .= "VALUES('$articleID', '$text','$autor', '$timestamp');";
        $conn = $this->connect();
        
        try {
            $conn->query($insert);
            
            return $articleID;
            
        } catch (PDOException $e) {
            print "Error createEntry()!: " . $e->getMessage() . "<br/>";
        }
        
    }
    
    function readAll($intVal = NULL) {
        $selectPost = '';
        
        if (is_numeric($intVal)) {
            $selectPost = " WHERE ArticleID = '$intVal' ";
        }
        
        $statement = "SELECT * FROM articlesmysql $selectPost ORDER BY TIMESTAMP DESC;";
        try {
            $conn = $this->connect();
            $returnValue = $conn->query($statement);
            return $returnValue->fetchAll();
            
        } catch (PDOException $e) {
            print "Error outputIndex()!: " . $e->getMessage() . "<br/>";
        }
        
    }
    
    function readComment($intVal = NULL) {
        
        $statement = "SELECT * FROM commentmysql  WHERE ArticleID = '$intVal' ORDER BY TIMESTAMP DESC;";
        try {
            $conn = $this->connect();
            $returnValue = $conn->query($statement);
            return $returnValue->fetchAll();
            
        } catch (PDOException $e) {
            print "Error outputIndex()!: " . $e->getMessage() . "<br/>";
        }
        
    }
    
  /*  function disconnect() {
        $this->connect() = NULL;
    }*/
}