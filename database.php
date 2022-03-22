<?php
    //mysql://b60b3237bc93ac:4fd01557@us-cdbr-east-05.cleardb.net/heroku_078050e6cb0afd3?reconnect=true
    $username = 'b60b3237bc93ac';
    $password = '4fd01557';
    $hostname='us-cdbr-east-05.cleardb.net';
    $database= 'heroku_078050e6cb0afd3';

    try{
        $conn= new PDO("mysql:host=$hostname; dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error: ". $e;
        }
?>