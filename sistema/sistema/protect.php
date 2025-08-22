<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
  
    header("Location: index.php");
    exit("Você não está logado. Página não acessível."); 
}
?>