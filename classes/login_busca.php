<?php

$comand=$_POST['entrar'];
$login = $_POST['login'];
$senha = $_POST['senha'];

include("functions.php");
$obj = new Crud_Pessoa();
$obj->login_select($login, $senha);


?>