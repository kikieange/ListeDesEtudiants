<?php 
$servername="localhost";
$dbname="tdbd2";
$user="root";
$pass="";
  try{
         $conn= new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $user, $pass);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
      }
            catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();

  }
 ?>