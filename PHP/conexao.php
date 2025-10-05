<?php
$host = 'localhost';
$dbname = ''
$user = ''
$pass = ''

try{
  //Cria a conexão PDO
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

//Configura o PDO para lançar excessões em caso de erro
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
  die("Erro na conexão: " .$e->getMessage());
}
?>
