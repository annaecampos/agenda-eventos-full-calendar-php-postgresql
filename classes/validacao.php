<?php
session_start(); 

include("functions.php");
$comand=$_POST['entrar'];
$login = $_POST['login'];
$senha = $_POST['senha'];

if((isset($_POST['login'])) && (isset($_POST['senha']))){

	$obj = new Crud_Pessoa();
	$resultado = $obj->login_select($login, $senha);

}

else
{
	header("location:login.php");
	
}

?>