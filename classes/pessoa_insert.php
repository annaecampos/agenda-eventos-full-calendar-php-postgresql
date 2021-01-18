<?php
include("functions.php");
$comand=$_POST['botaoSalvar'];

$nome=$_POST['nome'];
$telefone=$_POST['telefone'];
$cpf=$_POST['cpf'];
$email=$_POST['email'];


	//$login=$_POST['login'];
	//$senha=md5($_POST['senha']);
	$tipopessoa=2;
	//$nivel = $_POST['nivel'];

//$idsetor=$_POST['idsetor'];
$obj = new Crud_Pessoa();
$obj->pessoa_insert($nome,$telefone,$cpf,$email,$tipopessoa);

?>