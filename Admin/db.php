<?php 

$dbn='mysql:host=localhost;dbname=cv app';
$user='root';
$pass="";
$option=array(
    #Will automatically be re-executed when reconnecting.يخلي يتصل مباشلاة مع الداتابيس 
    PDO ::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
);
try{
    #we will use this variable as standard in any fetch data OR DEALINNG WITH DATA
    $connect=new PDO($dbn,$user,$pass,$option);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo 'faild to connect'.$e->getMessage();
}
?>